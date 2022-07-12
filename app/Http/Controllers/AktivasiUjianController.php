<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use ActiveStatus;
use App\Models\Jadwal;
use App\Models\Pelaksanaan;
use App\Models\Sesi;
use App\Models\Status;

class AktivasiUjianController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
        $this->middleware('role');
    }

    public function index() 
    { 
        $jadwal = Jadwal::getNearestJadwal()->withAll()->get();    

        $sesi = Sesi::pluck('nama', 'id')->prepend('Pilih Sesi', '');
        $status = Status::whereActive()->get();

        return view('pages.aktivasi.ujian', compact('jadwal', 'sesi', 'status'));
    }

    public function activate(Request $request) 
    {
        $this->validate($request, [
            'jadwal_id' => 'required|numeric',
            'sesi_id' => 'required|numeric',
            'status' => 'required',
            'token' => 'nullable'
        ]);

        // Check if already available
        $statusCount = Status::where('jadwal_id', $request->jadwal_id)->where('sesi_id', $request->sesi_id)->count();

        // Check if session has murid

        $jadwal = Jadwal::findOrFail($request->jadwal_id);

        $muridCount = Pelaksanaan::whereHas('murid', function($query) use($jadwal) {
            $query->where('kelas_id', $jadwal->kelas_id);
        })->where('sesi_id', $request->sesi_id)->count();


        if(!$muridCount) return redirect()->back()->withErrors('Sesi tidak memiliki murid.');
        
        if($statusCount) return redirect()->back()->withErrors('Aktivasi dengan jadwal dan sesi yang sama sudah ada.');
        
        $status = new Status($request->except('_token'));
        $status->save();
        
        return redirect()->route('aktivasi.index')->with('success', 'Berhasil mengaktivasi ujian');
    }

    public function updateStatus(Status $status, Request $request) 
    {
        $this->validate($request, [
            'status' => 'required',
        ]);

        $status->status = $request->status;
        $status->save();

        return redirect()->route('aktivasi.index')->with('success', 'Berhasil mengganti status');
    }

    public function delete(Status $status)
    {
        $status->delete();

        return redirect()->route('aktivasi.index')->with('success', 'Berhasil menghapus status');

    }

    public function getToken() 
    {
        return ActiveStatus::generateToken();
    }
}
