<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Score;
use App\Models\Nilai;
use App\Models\Jawaban;
use App\Models\Jadwal;
use Illuminate\Support\Facades\Validator;

class NilaiPilihanGandaOtomatisController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');    
    }

    public function __invoke(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'jadwal_id' => 'required',
            'murid_id' => 'required',
        ], [
            'jadwal_id.required' => 'Jadwal belum diisi',
            'murid_id.required' => 'Murid belum diisi'
        ]);

        if($validator->fails()) {
            return redirect()->back()->withErrors($validator->errors()->first());
        }

        $typeSoal = [
            'pilihanganda' => 1,
            'essay' => 2
        ];

        $jawaban = Jawaban::where('murid_id', $request->murid_id)->where('jadwal_id', $request->jadwal_id)
            ->whereHas('soal', function($query) use($typeSoal) {
                $query->where('jenis', $typeSoal['pilihanganda']);
        })->with('soal')->get()->sortBy('soal.nomor_soal');

        $jadwal = Jadwal::find($request->jadwal_id);

        $hitungNilai = Score::count($jawaban, $jadwal);

        Nilai::updateOrCreate(
            ['murid_id' => $request->murid_id, 'jadwal_id' => $request->jadwal_id],
            ['nilai' => $hitungNilai, 'status' => 'Dinilai']
        );

        return redirect()->route('nilai.edit', ['idMurid' => $request->murid_id, 'idJadwal' => $request->jadwal_id])
            ->with('success', 'Berhasil menilai soal PG');
    }
}
