<?php

namespace App\DataTables;

use App\Models\Coupon;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class CouponsDataTable extends DataTable
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
                if ($this->trash == null) {
                    $btn = ' <a href="' . route('coupons.change.status', $row->id) . '" class="btn btn-outline-danger m-1 btn-sm"> تفعيل/تعطيل</a>';
                    $btn .= ' <a href="/coupons/edit/' . $row->id . ' " class="btn btn-outline-warning btn-sm">تعديل</a>';
                    $btn .= ' <a href="' . route('clients.show', $row->id) . '" class="btn btn-outline-info btn-sm">عرض</a>';
                    $btn .= ' <button type="button" class="btn btn-outline-danger btn-sm" data-id="' . $row->id . '" data-name="' . $row->name . '" data-toggle="modal" data-target="#defaultSize">ارشفه</button>';
                } else {
                    $btn = '<form action="/coupons/restore" method="POST"><input type="hidden" name="_token" value="' . csrf_token() . '" /><input type="hidden" name="id" value="' . $row->id . '"/><button type="submit" class="btn btn-outline-warning btn-sm">استعاده</button>
                    </form>';
                }
                return $btn;
            })
            ->editColumn('status', function ($row) {
                $status = '';
                if ($row->status == 1)
                    $status .= "<span class='badge badge  badge-pill badge-success float-right'>مفعل</span>";
                else
                    $status .= "<span class='badge badge  badge-pill badge-danger float-right'>غير مفعل</span>";

                return $status;
            })
            ->editColumn('id', function ($row) {
                return "<input type='checkbox' name='coupons_ids[]' value='$row->id'/>";
            });
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Coupon $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Coupon $model)
    {
        return $model->newQuery()
            ->when($this->status != null, function ($query) {
                $query->where('status', '=', $this->status);
            })
            ->when($this->trash != null, function ($query) {
                $query->onlyTrashed();
            });
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
            ->setTableId('coupons-table')
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
                ->width(60)
                ->addClass('text-center'),
            Column::make('id'),
            Column::make('name'),
            Column::make('amount'),
            Column::make('type'),
            Column::make('status'),
            Column::make('start_at'),
            Column::make('end_at'),
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'Coupons_' . date('YmdHis');
    }
}
