<?php

namespace App\DataTables;

use App\Models\JenisUjian;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class JenisUjianDataTable extends DataTable
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
                if(auth('admin')->user()->hasRole('admin')) {
                    return "<div class='d-flex'>
                            <a href=" . route('jenisujian.edit', $item->id) . " class='btn btn-success btn-sm'><i class='fas fa-pencil-alt'></i></a>
                        
                            <form action=" . route('jenisujian.destroy', $item->id) . " class='ml-1 delete-form' data-target= '" . $item->id . "'  method='POST'>
                                " . csrf_field() ."
                                <input type='hidden' name='_method' value='delete'>
                                <button class='btn btn-danger btn-sm' onclick='showModal(`Apakah anda yakin ingin menghapus $item->nama ?`, `.delete-form`, `$item->id`);'>
                                    <i class='fas fa-trash'></i>
                                </button>
                            </form>
                        </div>";
                }
                
            })
            ->addColumn('tanggal_dibuat', function($item) {
                return $item->created_at;
            })->rawColumns(['aksi']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\App\JenisUjian $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(JenisUjian $model)
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
                    ->setTableId('jenisujian-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    ->dom('lBfrtip')
                    ->orderBy(0, 'asc')
                    ->buttons(
                        Button::make('create'),
                        Button::make('export'),
                        Button::make('print')
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
            Column::make('tanggal_dibuat'),
            Column::computed('aksi')
                  ->exportable(false)
                  ->printable(false)
                  ->width(60)
                  ->addClass('text-center')
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'JenisUjian_' . date('YmdHis');
    }
}
