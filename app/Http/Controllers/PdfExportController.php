<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DOMPDF;
use App\Models\Kelas;
use App\Models\Nilai;
use App\Models\Murid;

class PdfExportController extends Controller
{
    public $options;

    public function __construct()
    {
        $this->middleware('auth:admin');  
        $this->middleware('role');  

        $this->options = ['isHtml5ParserEnabled' => true, 'isRemoteEnabled' => true];

        ini_set('max_execution_time', '300');
    }

    public function viewExport() 
    {
        $kelas = Kelas::pluck('nama_kelas', 'id')->prepend('Pilih kelas', '');


        return view('pages.pdf.export-multiple', compact('kelas'));
    }

    public function createRaport($id) 
    {
        $murid = Murid::find($id);
        $nilai = Nilai::where('murid_id', $id)->with('jadwal')->get();

        $pdf =  DOMPDF::setOptions($this->options)
                    ->loadView('documents.nilaiexport', compact('nilai', 'murid'))->setPaper('letter', 'potrait');

        return $pdf->stream('data-raport.pdf');
    }

    public function createMultipleRaport(Request $request) 
    {
        $this->validate($request, [
            'murid' => 'required'
        ]);

        $muridInput = $request->input('murid');

        if(count($muridInput) > 10) {
            return redirect()->back()->withErrors('Jumlah murid tidak boleh lebih dari 10');
        }

        $murid = Murid::with('nilai')->findMany($muridInput);

        $pdf =  DOMPDF::setOptions($this->options)
                    ->loadView('documents.nilaimultipleexport', compact('murid'))->setPaper('letter', 'potrait');

        return $pdf->stream('data-raport.pdf');
    }
}
