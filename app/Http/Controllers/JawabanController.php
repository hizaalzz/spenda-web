<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Jawaban;
use App\Models\Murid;
use App\Models\Jadwal;
use App\Models\Nilai;
use Illuminate\Support\Facades\Validator;

class JawabanController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');    
    }

    public function show($idMurid, $idJadwal) 
    {
        $murid = Murid::find($idMurid);
        $jadwal = Jadwal::find($idJadwal);

        $jawaban = Jawaban::where('murid_id', $idMurid)->where('jadwal_id', $idJadwal)->with('soal')->get()
            ->sortBy('soal.nomor_soal');

        $nilai = Nilai::where('murid_id', $idMurid)->where('jadwal_id', $idJadwal)->select('nilai')->first();

        return view('pages.jawaban.details', compact('jawaban', 'murid', 'jadwal', 'nilai'));
    }

    public function searchById($id) 
    {
        $jawaban = Jawaban::select('status')->find($id);

        return response()->json($jawaban);
    }

    public function saveStatus(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'status' => 'required|in:Benar,Salah',
            'jawaban_id' => 'required'
        ]);

        if($validator->fails())
        {
            return response()->json('Error : ' . $validator->errors()->toArray(), 422);
        }

        $jawaban = Jawaban::findOrFail($request->jawaban_id);
        $jawaban->status = $request->status;

        $jawaban->save();

        return response()->json(true);

    }
}
