<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Soal;
use App\Models\Murid;
use App\Models\Status;
use App\Models\Pelaksanaan;
use ActiveStatus;
use Illuminate\Database\Eloquent\Collection;

class UjianController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('ujian.guards')->only('ujian');
    }

    public function persiapan() 
    {
        $status = null;

        $pelaksanaan = Pelaksanaan::where('murid_id', auth()->user()->murid->id)->first();
        $jadwal = ActiveStatus::getActiveJadwal();

        if($pelaksanaan != null && $jadwal != null) 
        {
            $status = Status::where('sesi_id', $pelaksanaan->sesi_id)->where('jadwal_id', $jadwal->id)->first();
        }

        return view('pages.ujian.dashboardujian', compact('jadwal', 'pelaksanaan', 'status'));
    }

    public function ujian() 
    {
        $pelaksanaan = Pelaksanaan::where('murid_id', auth()->user()->murid->id)->first();
        $jadwal = ActiveStatus::getActiveJadwal();

        if(!session()->has('soal')) {

            if($jadwal->banksoal === null) return redirect()->route('ujian.persiapan')->withErrors('Jadwal belum memiliki soal');

            $soal = Soal::where('bank_soal_id', $jadwal->bank_soal_id)->where('paket_id', $pelaksanaan->paket_id)
                ->excludeJawaban()->get()->shuffle()->sortBy('jenis');
                
            if(!$soal->count()) 
            {
                return redirect()->route('ujian.persiapan')->withErrors('Guru belum mengupload soal');
            }

            //session(['soal' => $soal]);

        } else {
            $soal = session('soal');
        }

        activity()->log(auth()->user()->nama. ' sedang melaksanakan ujian');

        return view('pages.ujian.ujian', compact('soal', 'jadwal'));
    }

    public function verifikasiToken(Request $request) 
    {
        $this->validate($request, [
            'jadwal_id' => 'required|numeric',
            'sesi_id' => 'required|numeric',
            'token' => 'required'
        ]);

        $status = Status::where('jadwal_id', $request->jadwal_id)->where('sesi_id', $request->sesi_id)->first();

        if($status == null) {
            return redirect()->route('ujian.persiapan')->withErrors('Ujian belum aktif');
        } 

        if($status->token != $request->token) {
            return redirect()->route('ujian.persiapan')->withErrors('Token tidak valid');
        }

        $request->session()->put('token_ujian', $request->token);

        return redirect()->route('ujian.mulai');
    }

    public function ujianSelesai(Request $request)
    {
        if($request->has('endtoken') && $request->endtoken === session('endtoken')) 
        {
            // Hapus token
            session()->forget('token_ujian');

            // Hapus soal
            session()->forget('soal');

            // Hapus endtoken
            session()->forget('endtoken');

            activity()->log(auth()->user()->nama. ' telah menyelesaikan ujian');

            return view('pages.ujian.selesai')->with('Terimakasih telah mengikuti ujian dengan jujur');
        }

        return redirect()->route('ujian.mulai');
    }

    public function showAccountInfo() 
    {
        $murid = Murid::with('kelas')->find(auth()->user()->murid_id);

        return view('pages.ujian.profile', compact('murid'));
    }
}
