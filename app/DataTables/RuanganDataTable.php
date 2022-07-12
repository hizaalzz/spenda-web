<?php

namespace App\DataTables;

use App\Models\Ruangan;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class RuanganDataTable extends DataTable
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
                if(auth('admin')->user()->can('delete', $item))
                {
                    return "<div class='d-flex'>

                        <form action=" . route('ruangan.destroy', $item->id) . " class='ml-1 delete-form' data-target= '" . $item->id . "'  method='POST'>
                            " . csrf_field() ."
                            <input type='hidden' name='_method' value='delete'>
                            <button class='btn btn-danger btn-sm' onclick='showModal(`Apakah anda yakin ingin menghapus ruangan $item->nama?`, `.delete-form`, `$item->id`);'>
                                <i class='fas fa-trash'></i>
                            </button>
                        </form>
                    </div>";
                }
            })->rawColumns(['aksi']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Ruangan $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Ruangan $model)
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

        if(auth('admin')->user()->can('create', Ruangan::class)) {
            array_unshift($buttons,Button::make('create')->action('showFormModal(`createModal`);'));
            
        }

        return $this->builder()
                    ->setTableId('ruangan-table')
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
        return 'Ruangan_' . date('YmdHis');
    }
}
