<?php

namespace App\DataTables;

use App\Models\Guru;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class GuruDataTable extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */
    protected $exportColumns = [
        'nama',
        'nuptk',
        'email',
        'jenis_kelamin',
        'tempat_lahir',
        'tanggal_lahir',
        'telp'
    ];

    public function dataTable($query)
    {
        return datatables()
            ->eloquent($query)
            ->addColumn('aksi', function($item) {
                if(auth('admin')->user()->can('create', Guru::class)) 
                {
                    return "<div class='d-flex'>
                        <a href=" . route('guru.edit', $item->id) . " class='btn btn-success btn-sm'><i class='fas fa-pencil-alt'></i></a>
                    
                        <form action=" . route('guru.destroy', $item->id) . " class='ml-1 delete-form' data-target='" . $item->id . "' method='POST'>
                            " . csrf_field() ."
                            <input type='hidden' name='_method' value='delete'>
                            <button class='btn btn-danger btn-sm' onclick='showModal(`Apakah anda yakin ingin menghapus guru $item->nama ?`, `.delete-form`, `$item->id`);'>
                                <i class='fas fa-trash'></i>
                            </button>
                        </form>
                    </div>";
                }   
        })->editColumn('nama', function($item) {
            return "<a href='" . route('guru.show', $item->id) . "'>" . $item->nama . "</a>";
        })->editColumn('telp', function($item) {
            return $item->telp ?? "-";
        })->editColumn('nuptk', function($item) {
            return $item->nuptk ?? "-";
        })->rawColumns(['nama', 'aksi']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Guru $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Guru $model)
    {
        return $model->whereHas('admin', function($q) {
            return $q->where('superadmin', false);
        });
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

        if(auth('admin')->user()->can('create', Guru::class))
        {
            array_unshift($buttons,Button::make('create'));
        }

        return $this->builder()
                    ->setTableId('guru-table')
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
            Column::make('nama', 'nama'),
            Column::make('nuptk'),
            Column::make('jenis_kelamin'),
            Column::make('telp'),
            Column::computed('aksi')
                ->exportable(false)
                ->printable(false)
                ->width(50)
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
        return 'Guru_' . date('YmdHis');
    }
}
