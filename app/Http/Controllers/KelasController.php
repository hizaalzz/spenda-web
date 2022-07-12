<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\DataTables\KelasDataTable;
use App\Http\Requests\KelasRequest;
use App\Models\Jurusan;
use App\Models\Kelas;
use App\Models\Level;
use App\Models\Murid;

class KelasController extends Controller
{
    public $level;
    public $jurusan;
    public $murid;

    public function __construct()
    {
        $this->middleware('auth:admin');
        // $this->authorizeResource(Kelas::class, 'kelas');

        $this->level = Level::pluck('nama', 'id')->prepend('Pilih Level', '');
        $this->jurusan = Jurusan::pluck('nama', 'id')->prepend('Pilih Tingkat Kelas', '');
        $this->murid = Murid::select(['id', 'nama', 'jenis_kelamin'])->whereNull('kelas_id')->get();
    }

    public function index(KelasDataTable $dataTable)
    {
        return $dataTable->render('pages.kelas.index');
    }

    public function create()
    {
        return view('pages.kelas.create', array('level' => $this->level, 'jurusan' => $this->jurusan, 'murid' => $this->murid));
    }

    public function store(KelasRequest $request)
    {
        $murid = $request->input('murid', null);

        $kelas = new Kelas($request->except(['_token', 'murid']));

        $kelas->save();

        if($murid != null) {
            foreach($murid as $item) {
                $muridDipilih = Murid::findOrFail($item);

                $muridDipilih->kelas_id = $kelas->id;
                $muridDipilih->save();
            }
        }

        return redirect()->route('class.index')->with('success', 'Berhasil membuat kelas');
    }

    public function show($id)
    {
        $kelas = Kelas::with('murid')->findOrFail($id);

        return view('pages.kelas.details', compact('kelas'));
    }

    public function edit($id)
    {
        $kelas = Kelas::findOrFail($id);
                   
        return view('pages.kelas.edit', array('kelas' => $kelas, 'level' => $this->level, 'jurusan' => $this->jurusan, 'murid' => $this->murid));
    }

    public function update(KelasRequest $request, Kelas $kelas)
    {
        $kelas->update([
            'nama_kelas' => $request->nama_kelas,
            'level_id' => $request->level_id
        ]);
        
        return redirect()->route('class.index')->with('success', 'Berhasil mengupdate kelas');

    }

    public function destroy(Kelas $kelas)
    {
        $kelas->delete();

        return redirect()->route('class.index')->with('success', 'Berhasil menghapus kelas');

    }
}
