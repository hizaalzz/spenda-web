<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests\ImportExcelRequest;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\GuruImport;
use App\Imports\MuridImport;

class ImportFromExcelController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');   
    }

    public function index() 
    {
        return view('pages.importall');
    }

    public function importData(ImportExcelRequest $request) 
    {
        if($request->type === 'Guru') {
            Excel::import(new GuruImport(), $request->file('data'));
        } else if($request->type === 'Murid') {
            Excel::import(new MuridImport(), $request->file('data'));
        }

        return redirect()->route('import.index')->with('success', 'Berhasil mengimport data');
    }
}
