<?php

namespace App\DataTables;

use App\Models\Murid;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class MuridDataTable extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */
    protected $exportColumns = [
        'nama',
        'nis',
        'nisn',
        'jenis_kelamin',
        'telp',
        'tempat_lahir',
        'tanggal_lahir'
    ];

    public function __construct()
    {
        error_reporting(E_ALL ^ E_DEPRECATED);
    }
    
    public function dataTable($query)
    {
        return datatables()
            ->eloquent($query)
            ->addColumn('aksi', function($item) {
                if(auth('admin')->user()->can('create', Murid::class)) 
                {
                    return "<div class='d-flex'>
                        <a href=" . route('murid.edit', $item->id) . " class='btn btn-success btn-sm'><i class='fas fa-pencil-alt'></i></a>
                    
                        <form action=" . route('murid.destroy', $item->id) . " class='ml-1 delete-form' data-target='" . $item->id . "' method='POST'>
                            " . csrf_field() ."
                            <input type='hidden' name='_method' value='delete'>
                            <button class='btn btn-danger btn-sm' onclick='showModal(`Apakah anda yakin ingin menghapus $item->nama?`, `.delete-form`, `$item->id`);'>
                                <i class='fas fa-trash'></i>
                            </button>
                        </form>
                    </div>";
                }
        })->editColumn('nama', function($item) {
            return "<a href='" . route('murid.show', $item->id) . "'>" . $item->nama . "</a>";
        })->editColumn('kelas', function($item) {
            return $item->kelas->nama_kelas ?? '-';
        })->editColumn('telp', function($item) {
            return $item->telp ?? '-';
        })->rawColumns(['nama', 'aksi']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Murid $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Murid $model)
    {
        return $model->with(['kelas' => function($query) {
            return $query->select('id', 'nama_kelas');
        }]);
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

        if(auth('admin')->user()->can('create', Murid::class)) 
        {
            array_unshift($buttons, Button::make('create'));
        }
        
        return $this->builder()
                ->setTableId('murid-table')
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
            Column::make('nis'),
            Column::make('jenis_kelamin'),
            Column::make('telp'),
            Column::make('kelas', 'kelas.nama_kelas'),
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
        return 'Murid_' . date('YmdHis');
    }
}
