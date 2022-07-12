<?php

namespace App\DataTables;

use App\Models\Logs;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class LogsDataTable extends DataTable
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
            ->addColumn('waktu', function($item) {
                return $item->created_at;
            })->addColumn('deskripsi', function($item) {
                return $item->description;
            })->addColumn('dilakukan_oleh', function($item) {
                $causer = $item->causer;

                if(isset($item->causer->nama)) 
                {
                    return "<a href=" . route('guru.show', $causer->id) . ">$causer->nama</a>";
                }

                return "-";
            })->rawColumns(['dilakukan_oleh']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\App\Log $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Logs $model)
    {
        return $model->orderBy('created_at', 'desc');
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
                    ->setTableId('logs-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    ->dom('lBfrtip')
                    ->orderBy(2, 'desc');
    }

    /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns()
    {
        return [
            Column::make('deskripsi'),
            Column::make('dilakukan_oleh'),
            Column::make('waktu')
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'Logs_' . date('YmdHis');
    }
}
