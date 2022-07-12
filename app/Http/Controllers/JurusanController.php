<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\DataTables\JurusanDataTable;
use App\Http\Requests\JurusanRequest;
use App\Models\Jurusan;
use App\Models\Matapelajaran;

class JurusanController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
        $this->authorizeResource(Jurusan::class, 'jurusan');
    }

    public function index(JurusanDataTable $dataTable)
    {        
        return $dataTable->render('pages.tingkat.index');    
    }

    public function create()
    {
        $matapelajaran = Matapelajaran::all();

        return view('pages.tingkat.create', compact('matapelajaran'));
    }

    public function store(JurusanRequest $request)
    {
        $jurusan = new Jurusan($request->except(['matapelajaran', 'matapelajaran_length']));

        $jurusan->save();

        $matapelajaran = $request->input(['matapelajaran'], null);

        if($matapelajaran != null) {
            foreach($matapelajaran as $pelajaran) {
                $jurusan->matapelajaran()->attach($pelajaran);
            }
        }

        return redirect()->route('tingkat.index')->with('success', 'Berhasil menambahkan');
    }

    public function show(Jurusan $jurusan)
    {
        return view('pages.tingkat.details', compact('jurusan'));
    }

    public function edit(Jurusan $jurusan)
    {
        $matapelajaran = Matapelajaran::all();

        return view('pages.tingkat.edit', compact('jurusan', 'matapelajaran'));
    }

    public function update(JurusanRequest $request, Jurusan $jurusan)
    {
        $jurusan->update([
            'kode_tingkat' => $request->kode_tingkat,
            'nama' => $request->nama
        ]);

        return redirect()->route('tingkat.index')->with('success', 'Berhasil mengupdate');
    }

    public function destroy(Jurusan $jurusan)
    {
        $jurusan->delete();

        return redirect()->route('tingkat.index')->with('success', 'Berhasil menghapus');
    }
}
