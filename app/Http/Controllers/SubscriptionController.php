<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Subscription;
use App\Models\Auth\User;
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
    public function index(Request $request){

    	// $subscriptions = Subscription::orderBy('updated_at', 'desc')->paginate();
    	// $users = User::where([
     //        ['confirmed', true],
     //        ['active', true],
     //        ['deleted_at', NULL]
     //    ])->get();

        // $tags = Tag::all()->where('type', 2);

    	// return view('backend.subscriptions.inscription.index', compact('subscriptions'));

        if ($request->ajax()) {
            // select('id', 'name', 'address', 'created_at', 'updated_at')
            $data = Subscription::query()->with('user')->select('subscriptions.*')->with('payments_one')->select('subscriptions.*');
            return Datatables::eloquent($data)
                    ->addIndexColumn()
                    // ->editColumn('created_at', function ($dat) {
                    //     return $dat->created_at ? with(new Carbon($dat->created_at))->format('d-m-Y H:i:s') : '';
                    // })
                    ->editColumn('id', function($row){
                        return '<a class="btn btn-sm btn-outline-dark" href="'. route('admin.subscription.subscription.show', $row->id) .'" role="button">
                                    #'. $row->id .'
                                  </a>';                        
                    })
                    ->addColumn('name', function (Subscription $subscription) {
                            return !empty($subscription->user->name) ? $subscription->user->name : '<span class="badge badge-pill badge-secondary"> <em>No definido</em></span>';
                    })
                    ->addColumn('payment', function (Subscription $payment) {
                            if($payment->payments_one) return (Carbon::now()->diffInDays($payment->payments_one->finish_date, false) >= 0) ?
                                '<a href="#" class="btn btn-sm btn-outline-info text-dark" tabindex="-1" role="button" aria-disabled="true">'.
                                    Carbon::now()->diffInDays($payment->payments_one->finish_date, false).' '.__('labels.backend.access.subscription.table.days_left').' ⇉ '.$payment->payments_one->finish_date
                                .'</a>'
                                 :'<span class="badge badge-pill badge-danger"> <em>Vencida</em></span>';
                            return '<span class="badge badge-pill badge-secondary"> <em>No asignada</em></span>';
                    })
                    ->addColumn('action', function($row){
                           $btn = '
                            <div class="btn-group" role="group" aria-label="'.__('labels.backend.access.users.user_actions').'">

                               <a href="'.route('admin.subscription.subscription.show', $row->id).'" data-toggle="tooltip" data-placement="top" title="'.__('buttons.general.crud.view').'" class="btn btn-info"><i class="fas fa-eye"></i></a>
                               <a href="'. route('admin.subscription.subscription.generate', $row->id) .'"  data-placement="top" title="'. __('buttons.general.crud.print') .'" target="_blank" class="btn btn-outline-info"><i class="fas fa-print"></i></a>

                                <a href="#" data-toggle="modal" data-target="#editModal" data-placement="top" title="'. __('buttons.general.crud.edit') .'" data-subid="'. $row->id .'"  data-price="'. $row->price .'" data-mycomment="'. $row->comment .'" data-start="'. $row->start_date .'" data-end="'. $row->finish_date .'" data-paymentmethod="'. optional($row->payment_method)->name .'" data-texticket="'. $row->ticket_text .'" data-name="'. $row->user->name .'" class="btn btn-primary"><i class="fas fa-edit"></i></a>
                                <a href="#" data-toggle="modal" data-target="#paymentModal" data-placement="top" data-userid="'. $row->user->id .'" data-subid="'. $row->id .'" data-name="'. $row->user->name .'" title="'. __('buttons.general.crud.edit') .'" class="btn btn-warning"> '.__('labels.backend.access.subscription.payment').'</a>
                                ';
                                if(Auth::user()->hasRole('administrator')){
                                $btn = $btn.'
                                <a href="'.route('admin.subscription.subscription.destroy', $row->id).'" class="btn btn-delete btn-outline-danger" title="'.$row->name.'" data-trans-button-confirm="'. __('buttons.general.crud.delete').'"  data-trans-button-cancel="'.__('buttons.general.cancel').'" data-trans-text="'.__('strings.backend.general.revert_this').'" data-trans-title="'.__('strings.backend.general.are_you_sure_delete').'" data-trans-success="'.__('strings.backend.general.success').'" data-trans-deleted="'.__('strings.backend.general.deleted').'" data-trans-wrong="'.__('strings.backend.general.wrong').'"><i class="fas fa-eraser"></i>
                                </a>
                                ';
                                }
                            return $btn;
                    })
                    ->rawColumns(['id', 'name', 'payment', 'action'])
                    ->toJson();
        }

        return view('backend.subscriptions.inscription.index');

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

        $customPaper = array(0,0,667.00,283.80);
        $pdf = PDF::loadView('inscription', compact('subscription'))->setPaper($customPaper, 'landscape');

        return $pdf->stream($subscription->user->name.'-inscripcion.pdf');
    }

    public function printpaymentsPDF($id, Request $request)
    {
        // $data = ['title' => 'Welcome to '];
        // $pdf = PDF::loadView('mypdf', $data);
        $subscription = Subscription::findOrFail($id);

        $payments = Payment::findOrFail($request->payment);

        $customPaper = array(0,0,667.00,283.80);
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
