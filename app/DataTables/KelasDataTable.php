<?php

namespace App\DataTables;

use App\Models\Kelas;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class KelasDataTable extends DataTable
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
                if(auth('admin')->user()->can('create', Kelas::class)) {
                    return "<div class='d-flex'>
                        <a href=" . route('class.edit', $item->id) . " class='btn btn-success btn-sm'><i class='fas fa-pencil-alt'></i></a>
                    
                        <form action=" . route('class.destroy', $item->id) . " class='ml-1 delete-form' data-target='" . $item->id . "' method='POST'>
                            " . csrf_field() ."
                            <input type='hidden' name='_method' value='delete'>
                            <button class='btn btn-danger btn-sm' onclick='showModal(`Apakah anda yakin ingin menghapus kelas $item->nama_kelas ?`, `.delete-form`, `$item->id`);'>
                                <i class='fas fa-trash'></i>
                            </button>
                        </form>
                    </div>";
                }
            })->editColumn('level', function($item) {
                return $item->level->nama;
            })->editColumn('nama_kelas', function($item) {
                return "<a href=" . route('class.show', $item->id) . ">". $item->nama_kelas  . "</a>";
            })->rawColumns(['nama_kelas', 'aksi']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Kela $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Kelas $model)
    {
        return $model->with('level');
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
            Button::make('reset'),
            Button::make('reload')
        ];

        if(auth('admin')->user()->can('create', Kelas::class)) {
            array_unshift($buttons,Button::make('create'));
        }

        return $this->builder()
                    ->setTableId('kelas-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    ->dom('lBfrtip')
                    ->orderBy(0)
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
            Column::make('nama_kelas'),
            Column::make('level', 'level'),
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'Kelas_' . date('YmdHis');
    }
}
