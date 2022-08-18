<?php

namespace App\DataTables;

use App\Models\Jadwal;
use Illuminate\Support\Facades\Request;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class JadwalDataTable extends DataTable
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
                if(auth('admin')->user()->can('create', Jadwal::class) && Request::is('jadwal')) {
                    return "<div class='d-flex'>
                        <a href=" . route('jadwal.edit', $item->id) . " class='btn btn-success btn-sm'><i class='fas fa-pencil-alt'></i></a>
                        <a href=". route('pelaksanaan.details', ['kelas' => $item->kelas_id, 'jadwal' => $item->id])  ." class='btn btn-warning btn-sm ml-1'><i class='fas fa-cog'></i></a>
                        <form action=" . route('jadwal.destroy', $item->id) . " class='ml-1 delete-form' data-target='" . $item->id . "' method='POST'>
                            " . csrf_field() ."
                            <input type='hidden' name='_method' value='delete'>
                            <button class='btn btn-danger btn-sm' onclick='showModal(`Apakah anda yakin ingin menghapus jadwal ini ?`, `.delete-form`, `$item->id`);'>
                                <i class='fas fa-trash'></i>
                            </button>
                        </form>
                    </div>";
                }

                if(Request::is('soal')) {
                    return "<a href=" . route('soal.show', $item->id) . " class='btn btn-primary btn-sm'>Lihat</a>";
                }
               
            })->addColumn('kelas', function($item) {
                return "<a href=" . route('class.show', $item->kelas_id) . ">" . $item->kelas->nama_kelas . "</a>";
            })->addColumn('matapelajaran', function($item) {
                return $item->matapelajaran->nama;
            })->addColumn('guru', function($item) {
                return "<a href=" . route('guru.show', $item->guru_id) . ">" . $item->guru->nama . "</a>";
            })->addColumn('jenis_ujian', function($item) {
                return $item->jenisujian->nama;
            })
            ->rawColumns(['kelas', 'guru', 'aksi']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Jadwal $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Jadwal $model)
    {
        if(auth('admin')->user()->hasRole('guru')) 
        {
            return $model->where('guru_id', auth('admin')->user()->guru_id)->withAll();
        }

        if($this->kelas !== null && !auth('admin')->user()->hasRole('guru')) 
        {
            return $model->where('kelas_id', $this->kelas)->withAll();
        }


        return $model->withAll();
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

        if(auth('admin')->user()->can('create', Jadwal::class)) 
        {
            array_unshift($buttons,Button::make('create')->action('redirectToCreate();'));
        }

        return $this->builder()
                    ->setTableId('jadwal-table')
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
            Column::make('matapelajaran'),
            Column::make('jenis_ujian', 'jenisujian.nama'),
            Column::make('kelas', 'kelas.nama_kelas'),
            Column::make('tanggal'),
            Column::make('guru', 'guru.nama'),
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
        return 'Jadwal_' . date('YmdHis');
    }
}
