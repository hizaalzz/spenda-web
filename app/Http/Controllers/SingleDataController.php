<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\BankSoal;
use App\Models\Guru;
use App\Models\Jadwal;
use App\Models\Soal;
use App\Models\Kelas;
use App\Models\Matapelajaran;

class SingleDataController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
        $this->middleware('must.ajax');
    }

    public function getMatapelajaranFromJurusan(Request $request) 
    {
        $jurusan = $request->jurusan;

        $matapelajaran = Matapelajaran::whereHas('jurusan', function($query) use($jurusan){
            $query->where('jurusan_id', $jurusan);
        })->get();

        return $matapelajaran;
    }

    public function getMatapelajaranFromKelas(Request $request) 
    {
        $kelas = Kelas::findOrFail($request->kelas_id);

        $jurusan = $kelas->jurusan_id;

        $matapelajaran = Matapelajaran::whereHas('jurusan', function($q) use($jurusan) {
            $q->where('jurusan_id', $jurusan);
        })->get();

        return $matapelajaran;
    }

    public function getGuruFromMatapelajaran(Request $request) 
    {
        $matapelajaran = $request->matapelajaran_id;

        $guru = Guru::whereHas('matapelajaran', function($q) use($matapelajaran) {
            $q->where('matapelajaran_id', $matapelajaran);
        })->get();

        return response()->json([
            'status' => 'OK',
            'data' => $guru
        ]);
    }
    
    public function getMuridFromKelas(Request $request) 
    {
        $kelas = Kelas::with('murid')->find($request->kelas);

        $murid = $kelas->murid->map(function($murid) {
            return collect($murid->toArray())->only('id', 'nama');
        });

        return $murid;
    }

    public function getSoalById(Request $request) 
    {
        $soal = Soal::find($request->soal_id);

        return $soal;
    }

    public function getBankSoalFromMatapelajaran(Request $request)
    {
        $banksoal = BankSoal::where('matapelajaran_id', $request->matapelajaran)->get();

        return $banksoal;
    }
}
