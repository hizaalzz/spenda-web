<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Jadwal;
use App\Models\Murid;
use App\Models\Nilai;
use App\Models\Jawaban;

class NilaiController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
        $this->middleware('nilai')->only('show');
        $this->middleware('nilai.edit')->only('edit');
    }

    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($idMurid)
    {
        $murid = Murid::findOrFail($idMurid);
        $jadwal = Jadwal::where('kelas_id', $murid->kelas_id)->get();

        return view('pages.nilai.details', compact('murid', 'jadwal'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($idMurid, $idJadwal)
    {
        $murid = Murid::find($idMurid);
        $jadwal = Jadwal::find($idJadwal);

        $jawaban = Jawaban::where('murid_id', $idMurid)->where('jadwal_id', $idJadwal)->with('soal')->get()
            ->sortBy('soal.nomor_soal');

        $nilai = Nilai::where('murid_id', $idMurid)->where('jadwal_id', $idJadwal)->select('id','nilai')->first();

        
        return view('pages.nilai.edit', compact('nilai', 'jadwal','jawaban', 'murid'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Nilai $nilai)
    {

        $this->validate($request, [
            'nilai' => 'required|numeric'
        ]);

        $nilai->nilai = $request->nilai;

        $nilai->save();

        return redirect()->route('penilaian.show', $nilai->murid->kelas_id)
            ->with('success', 'Berhasil mengupdate nilai');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
