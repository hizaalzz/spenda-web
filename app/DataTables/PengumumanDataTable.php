<?php

namespace App\DataTables;

use App\Models\Pengumuman;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class PengumumanDataTable extends DataTable
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
                if(auth('admin')->user()->can('create', Pengumuman::class)) {
                    return "<div class='d-flex'>
                        <a href=" . route('pengumuman.edit', $item->id) . " class='btn btn-success btn-sm'><i class='fas fa-pencil-alt'></i></a>
                    
                        <form action=" . route('pengumuman.destroy', $item->id) . " class='ml-1 delete-form' data-target='" . $item->id . "' method='POST'>
                            " . csrf_field() ."
                            <input type='hidden' name='_method' value='delete'>
                            <button class='btn btn-danger btn-sm' onclick='showModal(`Apakah anda yakin ingin menghapus $item->judul?`, `.delete-form`, `$item->id`);'>
                                <i class='fas fa-trash'></i>
                            </button>
                        </form>
                    </div>";
                }
            })->editColumn('judul', function($item) {
                return "<a href='" . route('pengumuman.show', $item->id) . "'>" . $item->judul . "</a>";
            })->rawColumns(['aksi', 'judul']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Pengumuman $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Pengumuman $model)
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
            Button::make('print')
        ];

        if(auth('admin')->user()->can('create', Pengumuman::class)) {
            array_unshift($buttons, Button::make('create'));
        }

        return $this->builder()
                    ->setTableId('pengumuman-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    ->dom('lBfrtip')
                    ->orderBy(1)
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
            Column::make('judul'),
            Column::make('jenis'),
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
        return 'Pengumuman_' . date('YmdHis');
    }
}
