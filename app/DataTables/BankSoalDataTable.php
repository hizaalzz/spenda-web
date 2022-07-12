<?php

namespace App\DataTables;

use App\Models\BankSoal;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class BankSoalDataTable extends DataTable
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
                return "<div class='d-flex'>
                        <a href=" . route('banksoal.show', $item->id) . " class='btn btn-warning btn-sm mr-1'><i class='fas fa-sticky-note'></i></a>
                        <a href=" . route('banksoal.edit', $item->id) . " class='btn btn-success btn-sm'><i class='fas fa-pencil-alt'></i></a>
                    
                        <form action=" . route('banksoal.destroy', $item->id) . " class='ml-1 delete-form' data-target='" . $item->id . "' method='POST'>
                            " . csrf_field() ."
                            <input type='hidden' name='_method' value='delete'>
                            <button class='btn btn-danger btn-sm' onclick='showModal(`Apakah anda yakin ingin menghapus bank soal ini ?`, `.delete-form`, `$item->id`);'>
                                <i class='fas fa-trash'></i>
                            </button>
                        </form>
                </div>";
            })->addColumn('level', function($item) {
                return "<div class='badge badge-primary'>" . $item->level->nama . " - " . $item->level->skala  . "</div>";
            })->addColumn('matapelajaran', function($item) {
                return $item->matapelajaran->nama;
            })->addColumn('tingkat', function($item) {
                return $item->jurusan->nama;
            })->addColumn('guru', function($item) {
                return $item->guru->nama;
            })->editColumn('opsi_pg', function($item) {
                $badge = "<div class='badge badge-success'>";
                $div = "</div>";

                if($item->opsi_pg === '2') {
                    return $badge . 'A-B' . $div;
                } else if($item->opsi_pg === '3') {
                    return $badge . 'A-C' . $div;
                } else if($item->opsi_pg === '4') {
                    return $badge . 'A-D' . $div;
                } else if($item->opsi_pg === '5') {
                    return $badge . 'A-E' . $div;
                }

            })->rawColumns(['opsi_pg', 'level', 'aksi']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\App\BankSoal $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(BankSoal $model)
    {
        return $model->with('level', 'matapelajaran', 'jurusan', 'guru');
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
                    ->setTableId('banksoal-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    ->dom('lBfrtip')
                    ->orderBy(0, 'asc')
                    ->buttons(
                        Button::make('create'),
                        Button::make('export'),
                        Button::make('print'),
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
            Column::make('id'),
            Column::make('opsi_pg'),
            Column::make('matapelajaran'),
            Column::make('tingkat'),
            Column::make('guru'),
            Column::make('level'),
            Column::make('status'),
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
        return 'BankSoal_' . date('YmdHis');
    }
}
