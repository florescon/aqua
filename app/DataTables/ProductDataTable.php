<?php

namespace App\DataTables;

use App\Product;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Html\Editor\Editor;
use Carbon;

class ProductDataTable extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */
 
    protected $printPreview = 'backend.datatable.product';


    public function dataTable($query)
    {

            $query = Product::query()->where('type', 1);
            return datatables()->eloquent($query)
                    ->addIndexColumn()
                    // ->editColumn('created_at', function ($dat) {
                    //     return $dat->created_at ? with(new Carbon($dat->created_at))->format('d-m-Y H:i:s') : '';
                    // })
                    ->addColumn('action', function($row){
                           $btn = '
                           <div class="btn-group" role="group" aria-label="'. __('labels.backend.access.users.user_actions') .'">
                            <a href="'. route('admin.inventory.product.show', $row->id) .'" data-toggle="tooltip" data-placement="top" title="'. __('buttons.general.crud.view') .'" class="btn btn-info"><i class="fas fa-eye"></i></a>

                           <a href="#" data-toggle="modal" data-placement="top" title="'. __('buttons.general.crud.edit') .'" class="btn btn-primary" data-id="'. $row->id .'" data-myname="'. $row->name .'" data-myquantity="'. $row->quantity .'" data-mycode="'. $row->code .'" data-myprice="'. $row->price .'" data-target="#editProduct"><i class="fas fa-edit"></i></a>
                            ';
                            $btn = $btn.'
                                <a href="#" data-toggle="modal" data-target="#stockModal" data-placement="top" data-product_id="'. $row->id .'" data-name="'. $row->name .'" data-quantity="'. $row->quantity .'" title="'. __('buttons.general.crud.edit') .'" class="btn btn-outline-info"><i class="fas fa-minus"></i>  '.__('labels.backend.access.product.table.quantity').' <i class="fas fa-plus"></i></a>
                            ';
                            $btn = $btn.'
                                <a href="'.route('admin.inventory.product.destroy', $row->id).'" class="btn btn-delete btn-outline-danger" title="'.$row->name.'" data-trans-button-confirm="'. __('buttons.general.crud.delete').'"  data-trans-button-cancel="'.__('buttons.general.cancel').'" data-trans-text="'.__('strings.backend.general.revert_this').'" data-trans-title="'.__('strings.backend.general.are_you_sure_delete').'" data-trans-success="'.__('strings.backend.general.success').'" data-trans-deleted="'.__('strings.backend.general.deleted').'" data-trans-wrong="'.__('strings.backend.general.wrong').'"><i class="fas fa-eraser"></i>
                                </a>
                            </div>    
                            ';
                            return $btn;
                    })
                    ->rawColumns(['action']);

    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Product $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Product $model)
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
            ['data' => 'id', 'title' => '#', 'printable' => false, 'exportable' => false],
            ['data' => 'code', 'title' => __('labels.backend.access.product.table.code')],
            ['data' => 'name', 'title' => __('labels.backend.access.product.table.name')],
            ['data' => 'quantity', 'title' => __('labels.backend.access.product.table.quantity')],
            ['data' => 'price', 'title' => __('labels.backend.access.product.table.price')],
            ['data' => 'created_at', 'title' => __('labels.backend.access.product.table.created')],
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'Products_' . date('d-m-Y__H.i.s');
    }
}
