<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Payment;
use App\Models\Auth\User;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\PaymentRequest;
use Carbon;
use PDF;

class PaymentController extends Controller
{

    public function index(){

    	$subscriptions = Payment::orderBy('updated_at', 'desc')->paginate(10);
    	$users = User::all()->where('confirmed', true)->where('active', true);

    	return view('backend.subscriptions.monthly.index', compact('subscriptions', 'users'));

    }


    public function store(PaymentRequest $request)
    {
    
        $payment = new Payment();
        $payment->user_id = $request->user;
        $payment->subscription_id = $request->sub;
        $payment->price = $request->price_;
        $payment->audi_id = Auth::id();
        $payment->start_date = $request->start_;
        $payment->finish_date = Carbon::parse($request->start_)->addMonth();
        $payment->comment = $request->comment_;
        $payment->payment_method_id = $request->payment_method_;
        $payment->ticket_text = $request->ticket_text_;
        $payment->save();

        $payment->tags()->attach($request->input('tags'));

	
	return redirect()->back()
      ->withFlashSuccess('Mensualidad guardada con éxito');

    }

    public function generatePDF($id)
    {
        // $data = ['title' => 'Welcome to '];
        // $pdf = PDF::loadView('mypdf', $data);
        $payment = Payment::findOrFail($id);

        $customPaper = array(5,-20,667.00,293.80);
        $pdf = PDF::loadView('payment', compact('payment'))->setPaper($customPaper, 'landscape');

        return $pdf->stream($payment->user->name.'-mensualidad.pdf');
    }


    public function select2LoadMore($id, Request $request)
    {
        $search = $request->get('search');
        $data = Payment::select(['id', 'created_at'])->where('id', 'LIKE', '%' . $search . '%')->where('subscription_id', $id)->orderBy('created_at', 'desc')->paginate(5);
        return response()->json(['items' => $data->toArray()['data'], 'pagination' => $data->nextPageUrl() ? true : false]);
    }


    public function destroy($id)
    {
        $section = Payment::findOrFail($id);
        $section->delete();

        return redirect()->back()->withFlashSuccess('Mensualidad eliminada con éxito');
    }



}
