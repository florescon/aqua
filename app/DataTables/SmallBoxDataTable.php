<?php

namespace App\DataTables;

use App\SmallBox;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Html\Editor\Editor;
use Carbon;

class SmallBoxDataTable extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */

    protected $printPreview = 'backend.datatable.smallbox';

    public function dataTable($query)
    {

        // select('id', 'name', 'address', 'created_at', 'updated_at')
        $query = SmallBox::query();
        return datatables()->eloquent($query)
                ->addIndexColumn()
                ->editColumn('created_at', function ($dat) {
                    return $dat->created_at ? with(new Carbon($dat->created_at))->format('d-m-Y H:i:s') : '';
                })
                ->addColumn('amount_edit', function (SmallBox $smallbox){
                    return $smallbox->type == 1 ? $smallbox->amount : -$smallbox->amount;
                })
                ->addColumn('comment_edit', function (SmallBox $smallbox){
                    return $smallbox->comment ? $smallbox->comment : '-- --';
                })
                ->addColumn('action', function($row){
                       $btn = '
                        <a href="'.route('admin.transaction.small.destroy', $row->id).'" class="btn btn-delete btn-outline-danger" title="'.$row->name.'" data-trans-button-confirm="'. __('buttons.general.crud.delete').'"  data-trans-button-cancel="'.__('buttons.general.cancel').'" data-trans-text="'.__('strings.backend.general.revert_this').'" data-trans-title="'.__('strings.backend.general.are_you_sure_delete').'" data-trans-success="'.__('strings.backend.general.success').'" data-trans-deleted="'.__('strings.backend.general.deleted').'" data-trans-wrong="'.__('strings.backend.general.wrong').'"><i class="fas fa-eraser"></i></a>
                       ';
                        return $btn;
                })
                ->rawColumns(['action']);
 
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\SmallBox $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(SmallBox $model)
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
            ['data' => 'name', 'title' => __('labels.backend.access.smallbox.table.name')],
            ['data' => 'amount_edit', 'title' => __('labels.backend.access.smallbox.table.amount')],
            ['data' => 'comment_edit', 'title' => __('labels.backend.access.smallbox.table.comment')],
            ['data' => 'created_at', 'title' => __('labels.backend.access.smallbox.table.created')],
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'SmallBox_' . date('YmdHis');
    }
}
