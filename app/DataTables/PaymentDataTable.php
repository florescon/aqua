<?php

namespace App\DataTables;

use App\Payment;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Html\Editor\Editor;
use Carbon;

class PaymentDataTable extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */

    protected $printPreview = 'backend.datatable.payment';


    public function dataTable($query)
    {
            $query = $query->with('user', 'generated_by')->orderBy('created_at', 'desc');
            return datatables()->eloquent($query)
                    ->addIndexColumn()
                    // ->editColumn('created_at', function ($dat) {
                    //     return $dat->created_at ? with(new Carbon($dat->created_at))->format('d-m-Y H:i:s') : '';
                    // })
                    ->addColumn('user', function (Payment $payment) {
                        return !empty($payment->user_id) ? $payment->user->name  : '<span class="badge badge-pill badge-secondary"> <em>No definido</em></span>';

                    })
                    ->addColumn('generated_by', function (Payment $payment) {
                            return !empty($payment->audi_id) ? $payment->generated_by->name  : '<span class="badge badge-pill badge-secondary"> <em>No definido</em></span>';

                    })
                    ->addColumn('action', function($row){
                           $btn = '
                            
                            ';
                            $btn = $btn.'
                                <a href="'. route('admin.subscription.payment.destroy', $row->id) .'" class="btn btn-delete btn-outline-danger" title="'.$row->name.'" data-trans-button-confirm="'. __('buttons.general.crud.delete').'"  data-trans-button-cancel="'.__('buttons.general.cancel').'" data-trans-text="'.__('strings.backend.general.revert_this').'" data-trans-title="'.__('strings.backend.general.are_you_sure_delete').'" data-trans-success="'.__('strings.backend.general.success').'" data-trans-deleted="'.__('strings.backend.general.deleted').'" data-trans-wrong="'.__('strings.backend.general.wrong').'"><i class="fas fa-eraser"></i>
                                </a>

                            ';
                            return $btn;
                    })
                    ->rawColumns(['user', 'generated_by', 'action']);

    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Payment $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Payment $model)
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
                    ->setTableId('payment-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    ->dom('Bfrtip')
                    ->orderBy(1)
                    ->buttons(
                        Button::make('create'),
                        Button::make('export'),
                        Button::make('print'),
                        Button::make('reset'),
                        Button::make('reload')
                    );
    }

    /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns()
    {
        return [
            ['data' => 'id', 'title' => '#', 'printable' => false, 'exportable' => false],
            ['data' => 'user', 'title' => __('labels.backend.access.payment.table.user')],
            ['data' => 'price', 'title' => __('labels.backend.access.payment.table.price')],
            ['data' => 'start_date', 'title' => __('labels.backend.access.payment.table.start')],
            ['data' => 'finish_date', 'title' => __('labels.backend.access.payment.table.end')],
            ['data' => 'created_at', 'title' => __('labels.backend.access.payment.table.created')],
            ['data' => 'generated_by', 'title' => __('labels.backend.access.payment.table.generated_by')],
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'Payment_' . date('d-m-Y__H.i.s');
    }
}
