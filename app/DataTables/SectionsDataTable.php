<?php

namespace App\DataTables;

use App\Models\Section;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class SectionsDataTable extends DataTable
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
            ->eloquent($query->with('_parent'))
            ->filter(function ($query) {
                if (request()->has('search')) {
                    $query->whereTranslationLike('section_name', '%' . request('search')['value'] . '%')->get();
                }
            })
            ->addColumn('action', function ($row) {
                if ($this->trash == null) {
                    $btn = '<a href="' . route('section.delete', $row->id) . '" class="btn btn-outline-primary btn-sm">ارشفه</a>';
                    $btn .= ' <button type="button" class="btn btn-outline-danger btn-sm" data-id="' . $row->id . '" data-name="' . $row->translate('ar')->section_name . '" data-toggle="modal" data-target="#defaultSize">حذف</button>';
                    $btn .= ' <a href="/sections/' . $row->id . '/edit" class="btn btn-outline-warning btn-sm">تعديل</a>';
                } else {
                    $btn = ' <a href="/section-restore/' . $row->id . '" class="btn btn-outline-warning btn-sm">استعاده</a>';
                }
                return $btn;
            })
            ->addColumn('image', function ($row) {
                $image = 'uploads/sections/default.jpg';
                if ($row->file->first())
                    $image = $row->file->first()->file_name;
                return "<img style='width:80px; height:60px' src='" . asset('storage/' . $image) . "'/>";

            })

            ->rawColumns(['action'])
            ->editColumn('active', function ($row) {
                $status = '';
                if ($row->active == 1)
                    $status .= "<span class='badge badge pr-2 pl-2 badge-pill badge-success float-right mr-2'>مفعل</span>";
                else
                    $status .= "<span class='badge badge pr-2 pl-2 badge-pill badge-danger float-right mr-2'>غير مفعل</span>";

                return $status;
            })
            ->editColumn('parent_id', function ($row) {
                if ($row->parent_id)
                    return $row->_parent->section_name;
                else
                    return "قسم رئيسى";


            })
            ->editColumn('id', function ($row) {
                return "<input type='checkbox' name='section_ids[]' value='$row->id'/>";
            })
        ;
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Section $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Section $model)
    {
        return $model->newQuery()->when($this->trash != null, function ($query) {
            $query->onlyTrashed();
        })->with('file');
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
            ->parameters([
                'dom' => 'Bfrtip',
                'buttons' => ['export', 'print', 'reset', 'reload'],
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
            Column::computed('action')
                ->exportable(false)
                ->printable(false)
                ->width(200)
                ->addClass('text-center'),
            Column::make('id'),
            Column::make('section_name'),
            Column::make('active'),
            Column::make('parent_id'),
            Column::make('image'),
            Column::make('created_at'),
            Column::make('updated_at'),
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'Sections_' . date('YmdHis');
    }
}
