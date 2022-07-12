<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\DataTables\JenisUjianDataTable;
use App\Http\Requests\JenisUjianRequest;
use App\Models\JenisUjian;

class JenisUjianController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
        $this->middleware('role')->except('index');   
    }

    public function index(JenisUjianDataTable $dataTable)
    {
        return $dataTable->render('pages.jenisujian.index');
    }

    public function create()
    {
        return view('pages.jenisujian.create');
    }

    public function store(JenisUjianRequest $request)
    {
        $jenisUjian = new JenisUjian($request->except('_token'));

        $jenisUjian->save();

        return redirect()->route('jenisujian.index')->with('success', 'Berhasil membuat jenis ujian');
    }

    public function show($id)
    {
        //
    }

    public function edit(JenisUjian $jenisujian)
    {
        return view('pages.jenisujian.edit', compact('jenisujian'));
    }

    public function update(JenisUjianRequest $request, JenisUjian $jenisujian)
    {
        $jenisujian->update([
            'nama' => $request->nama
        ]);

        return redirect()->route('jenisujian.index')->with('success', 'Berhasil mengupdate jenis ujian');
    }

    public function destroy(JenisUjian $jenisujian)
    {
        $jenisujian->delete();

        return redirect()->route('jenisujian.index')->with('success', 'Berhasil menghapus jenis ujian');
    }
}
