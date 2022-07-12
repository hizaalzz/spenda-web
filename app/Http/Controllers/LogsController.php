<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Logs;
use App\DataTables\LogsDataTable;

class LogsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
        $this->middleware('role');
    }

    public function index(LogsDataTable $dataTable) 
    {
        return $dataTable->render('pages.log');
    }
    
    public function destroy() 
    {
        if(!auth()->user()->can('hapus-log')) return abort(404);

        try {
            Logs::truncate();

            activity()->log('Seluruh log telah dihapus');

        } catch(\Exception $ex) {
            return redirect()->route('log.index')->withErrors('Gagal menghapus catatan aktivitas');
        }

        return redirect()->route('log.index')->with('success', 'Berhasil menghapus semua catatan aktivitas');
    }
}
