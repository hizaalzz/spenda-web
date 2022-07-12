<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Kelas;
use App\Models\Murid;

class KelasMuridController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');    
    }

    public function index()
    {
        $murid = Murid::select(['id', 'nama', 'jenis_kelamin'])->whereNull('kelas_id')->get();
        $kelas = Kelas::pluck('nama_kelas', 'id')->prepend('Pilih Kelas', '');

        return view('pages.kelasmurid.index', compact('murid', 'kelas'));
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'kelas_id' => 'required',
            'murid_id' => 'required'
        ]);
        
        $murid = $request->input('murid_id', null);

        foreach($murid as $item) 
        {
            $muridDipilih = Murid::findOrFail($item);

            $muridDipilih->kelas_id = $request->kelas_id;
            $muridDipilih->save();
        }

        return redirect()->route('kelasmurid.index')->with('success', 'Berhasil menambahkan murid');

    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
}
