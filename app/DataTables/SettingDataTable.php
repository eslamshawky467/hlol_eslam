<?php

namespace App\DataTables;

use App\Models\Setting;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class SettingDataTable extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public function dataTable($query)
    {
        $query->where('type', '=', 'fqa');
        return datatables()
            ->eloquent($query)
            ->addColumn('action', function ($row) {
                $btn = ' <a href="/settings/fqa/update/' . $row->id . '" class="btn btn-outline-warning btn-sm">تعديل</a>';
                $btn .= ' <button type="button" class="btn btn-outline-danger btn-sm" data-id="' . $row->id . '" data-name="' . $row->title_ar . '" data-toggle="modal" data-target="#defaultSize">حذف</button>';
                $btn .= ' <a href="#" class="btn btn-outline-info btn-sm">عرض</a>';
                return $btn;
            })
            ->editColumn('id', function ($row) {
                return "<input type='checkbox' name='settings_ids[]' value='$row->id'/>";
            });
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Setting $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Setting $model)
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
            ->setTableId('setting-table')
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
            Column::make('title_ar'),
            Column::make('title_en'),
            Column::make('content_ar'),
            Column::make('content_en'),
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'Setting_' . date('YmdHis');
    }
}
