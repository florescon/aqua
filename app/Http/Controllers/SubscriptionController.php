<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Subscription;
use App\Models\Auth\User;
use App\DataTables\SubscriptionDataTable;
use App\Payment;
use Illuminate\Support\Facades\Auth;
use App\Tag;
use PDF;
use App\Http\Requests\SubscriptionRequest;
use App\Http\Requests\SubscriptionUpdateRequest;
use DataTables;
use Carbon\Carbon;

class SubscriptionController extends Controller
{
    public function index(SubscriptionDataTable $dataTable){

        return $dataTable->render('backend.subscriptions.inscription.index');

    }


    public function store(SubscriptionRequest $request)
    {
    
        $inscription = new Subscription();
        $inscription->user_id = $request->user;
        $inscription->price = $request->price;
        $inscription->audi_id = Auth::id();
        $inscription->start_date = $request->start_index;
        $inscription->finish_date = Carbon::parse($request->start_index)->addYear();
        $inscription->comment = $request->comment;
        $inscription->payment_method_id = $request->payment_method;
        $inscription->ticket_text = $request->ticket_text;
        // $inscription->finish_date = $request->end;

        $inscription->save();

	return redirect()->route('admin.subscription.subscription.index')
      ->withFlashSuccess('Inscripcion guardada con éxito');

    }


    public function update(SubscriptionUpdateRequest $request)
    {
        // $subscription = Subscription::findOrFail($request->sub);
        // $subscription->update($request->all());
        
        $inscription = Subscription::findOrFail($request->sub);
        $inscription->start_date = $request->start_date;
        $inscription->finish_date = Carbon::parse($request->start_date)->addYear();
        $inscription->comment = $request->comment;
        $inscription->ticket_text = $request->ticket_text;
        $inscription->update();
        
        return back()->withFlashSuccess('Inscripcion actualizada con éxito');
    }


    public function show($id)
    {
        $subscription = Subscription::findOrFail($id);
        // $tags = Tag::whereType(2)->get();
       
        return view('backend.subscriptions.inscription.show', compact('subscription'));
    }

    public function print($subscription)
    {
        $subscriptions = Subscription::findOrFail($subscription);
        return view('backend.subscriptions.inscription.invoice', compact('subscriptions'));
    }


    public function generatePDF($id)
    {
        // $data = ['title' => 'Welcome to '];
        // $pdf = PDF::loadView('mypdf', $data);
        $subscription = Subscription::findOrFail($id);

        $customPaper = array(5,-20,667.00,293.80);
        $pdf = PDF::loadView('inscription', compact('subscription'))->setPaper($customPaper, 'landscape');

        return $pdf->stream($subscription->user->name.'-inscripcion.pdf');
    }

    public function printpaymentsPDF($id, Request $request)
    {
        // $data = ['title' => 'Welcome to '];
        // $pdf = PDF::loadView('mypdf', $data);
        $subscription = Subscription::findOrFail($id);

        $payments = Payment::findOrFail($request->payment);

        $customPaper = array(5,-20,667.00,293.80);
        $pdf = PDF::loadView('inscriptionpayment', compact('subscription', 'payments'))->setPaper($customPaper, 'landscape');

        return $pdf->stream($subscription->user->name.'-inscripcion-mensualidad.pdf');
    }

    public function search(Request $request){
        $searching = $request->input('search');

        //now get all user and services in one go without looping using eager loading
            //In your foreach() loop, if you have 1000 users you will make 1000 queries
          $subscriptions = Subscription::where('id','like','%'.$searching.'%')->orderBy('id')->paginate(15);
            return view('backend.subscriptions.inscription.index', compact('subscriptions'));
    }

    public function destroy($id)
    {
        $section = Subscription::findOrFail($id);
        $section->delete();

        return redirect()->route('admin.subscription.subscription.index')->withFlashSuccess('Inscripcion eliminada con éxito');
    }

}
