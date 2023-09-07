<?php

namespace App\DataTables;

use App\Models\Client;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class ClientsDataTable extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public function dataTable($query)
    {
        return datatables()
            ->eloquent($query)
            ->addColumn('action', function ($row) {
                $btn = ' <a href="/client/change-status/' . $row->id . '" class="btn btn-outline-danger m-1 btn-sm"> تفعيل/تعطيل</a>';
                $btn .= ' <a href="/clients/' . $row->id . '/edit" class="btn btn-outline-warning btn-sm">تعديل</a>';
                $btn .= ' <a href="' . route('clients.show', $row->id) . '" class="btn btn-outline-info btn-sm">عرض</a>';
                return $btn;
            })
            ->editColumn('status', function ($row) {
                $status = '';
                if ($row->status == 'active')
                    $status .= "<span class='badge badge pr-2 pl-2 badge-pill badge-success float-right mr-2'>مفعل</span>";
                else
                    $status .= "<span class='badge badge pr-2 pl-2 badge-pill badge-danger float-right mr-2'>غير مفعل</span>";

                return $status;
            })
            ->editColumn('is_registered', function ($row) {
                $is_registered = '';
                if ($row->is_registered == 1)
                    $is_registered .= "<span class='badge badge pr-2 pl-2 badge-pill badge-success float-right mr-2'>مسجل</span>";
                else
                    $is_registered .= "<span class='badge badge pr-2 pl-2 badge-pill badge-danger float-right mr-2'>غير مسجل</span>";

                return $is_registered;
            })
            ->editColumn('id', function ($row) {
                return "<input type='checkbox' name='clients_ids[]' value='$row->id'/>";
            });
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Client $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Client $model)
    {
        return $model->newQuery()
            ->when($this->status != null, function ($query) {
                $query->where('status', '=', $this->status);
            })
            ->when($this->is_registered != null, function ($query) {
                $query->where('is_registered', '=', $this->is_registered);
            });
        ;
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
            ->setTableId('clients-table')
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
            Column::computed('action')
                ->exportable(false)
                ->printable(false)
                ->width(100),
            Column::make('id'),
            Column::make('name'),
            Column::make('email'),
            Column::make('phone_number'),
            Column::make('is_registered'),
            Column::make('status'),
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'Clients_' . date('YmdHis');
    }
}
