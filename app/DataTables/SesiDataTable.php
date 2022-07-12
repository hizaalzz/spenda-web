<?php

namespace App\DataTables;

use App\Models\Sesi;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class SesiDataTable extends DataTable
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
            ->addColumn('aksi', function($item) {
                if(auth('admin')->user()->can('create', Sesi::class)) {
                    return "<div class='d-flex'>
                            <a href=" . route('sesi.edit', $item->id) . " class='btn btn-success btn-sm'><i class='fas fa-pencil-alt'></i></a>
                        
                            <form action=" . route('sesi.destroy', $item->id) . " class='ml-1 delete-form' data-target= '" . $item->id . "'  method='POST'>
                                " . csrf_field() ."
                                <input type='hidden' name='_method' value='delete'>
                                <button class='btn btn-danger btn-sm' onclick='showModal(`Apakah anda yakin ingin menghapus $item->nama ?`, `.delete-form`, `$item->id`);'>
                                    <i class='fas fa-trash'></i>
                                </button>
                            </form>
                        </div>";
                }
            })->addColumn('mulai', function($item) {
                return $item->start;
            })->addColumn('selesai', function($item) {
                return $item->end;
            })->rawColumns(['aksi']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Sesi $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Sesi $model)
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
        $buttons = [
            Button::make('export'),
            Button::make('print'),
            Button::make('reload')
        ];

        if(auth('admin')->user()->can('create', Sesi::class)) {
            array_unshift($buttons, Button::make('create'));
        }

        return $this->builder()
                    ->setTableId('sesi-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    ->dom('lBfrtip')
                    ->orderBy(0, 'asc')
                    ->buttons(
                        $buttons
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
            Column::make('nama'),
            Column::make('mulai'),
            Column::make('selesai'),
            Column::computed('aksi')
                  ->exportable(false)
                  ->printable(false)
                  ->width(60)
                  ->addClass('text-center'),
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'Sesi_' . date('YmdHis');
    }
}
