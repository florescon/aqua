<?php

namespace App\DataTables;

use App\Models\Auth\User;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Html\Editor\Editor;
use Carbon;

class UserDataTable extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */

    protected $printPreview = 'backend.datatable.user';

    public function dataTable($query)
    {

        $query = User::query()->whereHas('roles', function($q){ $q->where("name", "user"); })->with('customer')->select('users.*')->active();
        return datatables()->eloquent($query)
                ->addIndexColumn()
                // ->editColumn('created_at', function ($dat) {
                //     return $dat->created_at ? with(new Carbon($dat->created_at))->format('d-m-Y H:i:s') : '';
                // })
                ->editColumn('updated_at', function ($dat) {
                    return $dat->updated_at ? with(new Carbon($dat->updated_at))->format('d-m-Y H:i:s') : '';
                })
                ->addColumn('ins', function (User $user) {
                        return !empty($user->customer->ins) ? $user->customer->ins : '--';
                })
                ->addColumn('phone', function (User $user) {
                        return !empty($user->customer->phone) ? $user->customer->phone : '--';
                })
                ->addColumn('action', function($row){
                       $btn = '
                        <div class="btn-group" role="group" aria-label="'.__('labels.backend.access.users.user_actions').'">

                           <a href="'.route('admin.customer.show', $row->id).'" data-toggle="tooltip" data-placement="top" title="'.__('buttons.general.crud.view').'" class="btn btn-info"><i class="fas fa-eye"></i></a>
                            ';
                            $btn = $btn.'
                            <a href="'.route('admin.customer.edit', $row->id).'" data-toggle="tooltip" data-placement="top" title="'.__('buttons.general.crud.edit').'" class="btn btn-primary"><i class="fas fa-edit"></i></a>
                        </div>
                        ';
                        return $btn;
                })
                ->rawColumns(['ins', 'action']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\User $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(User $model)
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
            ['data' => 'first_name', 'title' => __('labels.backend.access.users.table.first_name')],
            ['data' => 'last_name', 'title' => __('labels.backend.access.users.table.last_name')],
            ['data' => 'email', 'title' => __('labels.backend.access.users.table.email')],
            ['data' => 'phone', 'title' => __('labels.backend.access.users.tabs.content.overview.phone')],
            ['data' => 'ins', 'title' => __('labels.backend.access.users.tabs.content.overview.ins')],
            ['data' => 'created_at', 'title' => __('labels.backend.access.users.table.created')],
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'Users_' . date('d-m-Y__H.i.s');
    }
}
