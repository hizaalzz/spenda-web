<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Jadwal;
use App\Models\Sesi;
use App\Models\Kelas;
use App\Models\Paket;
use App\Models\Pelaksanaan;
use App\Models\Ruangan;
use App\Http\Requests\PelaksanaanRequest;

class PelaksanaanController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
        $this->middleware('role');
    }

    public function index()
    {
        $kelas = Kelas::select('nama_kelas', 'id')->get();

        return view('pages.pelaksanaan.index', compact('kelas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Kelas $kelas)
    {
        $pelaksanaan = Pelaksanaan::pluck('murid_id');
        $jadwal = Jadwal::passed()->where('kelas_id', $kelas->id)->get();

        $murid = $kelas->murid;


        return view('pages.pelaksanaan.create', compact('kelas','murid', 'jadwal'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PelaksanaanRequest $request)
    {
        $murid = $request->input(['murid_id']);

        foreach($murid as $item) {
            $check = Pelaksanaan::where('murid_id', $item)->where('jadwal_id', $request->jadwal_id)->count();
            
            if($check) continue;

            $pelaksanaan = new Pelaksanaan($request->except('murid_id', '_token'));
            $pelaksanaan->murid_id = $item;

            $pelaksanaan->save();
        }

        return redirect()->route('pelaksanaan.details', $request->route('kelas'))->with('success', 'Berhasil menyimpan');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Kelas $kelas)
    {
        $pelaksanaan = null;

        $jadwal = Jadwal::where('kelas_id', $kelas->id)->select('id', 'nama', 'jenisujian_id', 'matapelajaran_id', 'guru_id')
            ->with(['guru' => function($query) {
                $query->select('id', 'nama');
            }])->with('matapelajaran')->get();

        if($request->has('jadwal')) 
        {
            $pelaksanaan = Pelaksanaan::whereHas('murid', function($query) use($kelas) {
                $query->where('kelas_id', $kelas->id);
            })->where('jadwal_id', $request->jadwal)->withAll()->get();

        } else {
            $pelaksanaan = Pelaksanaan::whereHas('murid', function($query) use($kelas) {
                $query->where('kelas_id', $kelas->id);
            })->withAll()->get();

        }

        return view('pages.pelaksanaan.details', compact('kelas', 'pelaksanaan', 'jadwal'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Pelaksanaan $pelaksanaan)
    {
        $sesi = Sesi::pluck('nama', 'id')->prepend('Pilih Sesi', '');
        $ruangan = Ruangan::pluck('nama', 'id')->prepend('Pilih Ruangan', '');
        $paket = Paket::pluck('kode_soal', 'id')->prepend('Pilih Paket Soal', '');


        return view('pages.pelaksanaan.edit', compact('pelaksanaan', 'sesi', 'ruangan', 'paket'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PelaksanaanRequest $request, Pelaksanaan $pelaksanaan)
    {
        $pelaksanaan->update([
            'sesi_id' => $request->sesi_id,
            'ruangan_id' => $request->ruangan_id,
            'paket_id' => $request->paket_id,
        ]);


        return redirect()->route('pelaksanaan.details', $request->kelas_id)
            ->with('success', 'Berhasil mengupdate');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Pelaksanaan $pelaksanaan)
    {
        $kelas = $request->kelas_id;

        $pelaksanaan->delete();

        return redirect()->route('pelaksanaan.details', $kelas)->with('success', 'Berhasil menghapus');

    }
}
