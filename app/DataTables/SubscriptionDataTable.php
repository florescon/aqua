<?php

namespace App\DataTables;

use App\Subscription;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Html\Editor\Editor;
use Carbon;

class SubscriptionDataTable extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */

    protected $printPreview = 'backend.datatable.inscription';


    public function dataTable($query)
    {

            // select('id', 'name', 'address', 'created_at', 'updated_at')
            $query = Subscription::query()->with('user', 'payments_one')->select('subscriptions.*')->with('payments_one')->select('subscriptions.*');
            return datatables()->eloquent($query)
                    ->addIndexColumn()
                    // ->editColumn('created_at', function ($dat) {
                    //     return $dat->created_at ? with(new Carbon($dat->created_at))->format('d-m-Y H:i:s') : '';
                    // })
                    ->addColumn('folio', function(Subscription $row){
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
                    ->addColumn('payment_date', function(Subscription $payment){
                            if($payment->payments_one) return $payment->payments_one->finish_date;

                    })
                    ->addColumn('action', function($row){
                           $btn = '
                            <div class="btn-group" role="group" aria-label="'.__('labels.backend.access.users.user_actions').'">

                               <a href="'.route('admin.subscription.subscription.show', $row->id).'" data-toggle="tooltip" data-placement="top" title="'.__('buttons.general.crud.view').'" class="btn btn-info"><i class="fas fa-eye"></i></a>
                               <a href="'. route('admin.subscription.subscription.generate', $row->id) .'"  data-placement="top" title="'. __('buttons.general.crud.print') .'" target="_blank" class="btn btn-outline-info"><i class="fas fa-print"></i></a>

                                <a href="#" data-toggle="modal" data-target="#editModal" data-placement="top" title="'. __('buttons.general.crud.edit') .'" data-subid="'. $row->id .'"  data-price="'. $row->price .'" data-mycomment="'. $row->comment .'" data-start="'. $row->start_date .'" data-end="'. $row->finish_date .'"  data-texticket="'. $row->ticket_text .'" data-name="'. $row->user->name .'" class="btn btn-primary"><i class="fas fa-edit"></i></a>
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
                    ->rawColumns(['folio', 'name', 'payment', 'action']);

    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Subscription $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Subscription $model)
    {
        return $model->newQuery();
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
                    ->columns($this->getColumns())
                    ->ajax('')
                    ->addAction(['width' => '10%', 'printable' => false])
                    ->parameters([
                        'order' => [0, 'asc'],
                        'pageLength' => 10,
                        'responsive' => true,
                        'autoWidth' => false,
                        'dom'          => 'lBfrtip',
                        'buttons'      => [
                            ['extend' => 'export', 'text' => 'Exportar&nbsp;<i class="fa fa-caret-down"></i>'],
                            ['extend' => 'print', 'text' => 'Imprimirr&nbsp;<i class="fa fa-print"></i>'],
                        ],
                        'language' => [
                            'url' => url('//cdn.datatables.net/plug-ins/1.10.19/i18n/Spanish.json')
                        ],
                    ]);
    }

    /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns()
    {
        return [
            ['data' => 'id', 'title' => 'Folio'],
            ['data' => 'name', 'title' => __('labels.backend.access.subscription.table.user')],
            ['data' => 'payment_date', 'title' => __('labels.backend.access.subscription.table.last_payment_date')],
            ['data' => 'finish_date', 'title' => __('labels.backend.access.subscription.table.end')],
            ['data' => 'created_at', 'title' => __('labels.backend.access.subscription.table.created')],
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'Inscriptions_' . date('d-m-Y__H.i.s');
    }
}
