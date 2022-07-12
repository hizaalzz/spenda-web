<?php

namespace App\Http\Middleware;

use Closure;

use Carbon\Carbon;
use TimeHelper;
use ActiveStatus;
use App\Models\Jawaban;
use App\Models\Nilai;
use App\Models\Status;

class UjianGuards
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle($request, Closure $next)
    {
        $jadwal = ActiveStatus::getActiveJadwal();
        $sesi = ActiveStatus::getMuridSession();

        if($jadwal === null || $sesi === null) {
            return redirect()->route('ujian.persiapan')
                ->withErrors('Anda tidak memiliki ujian aktif');
        }

        $status = Status::where('sesi_id', $sesi->id)->where('jadwal_id', $jadwal->id)->first();

        // Check status
        if($status->status === 'Nonaktif') {
            return redirect()->route('ujian.persiapan')
                    ->withErrors('Ujian belum diaktifkan');
        }

        session(['endtoken' => ActiveStatus::generateToken(8)]);

        $dimulai = Carbon::parse(TimeHelper::convert($jadwal->tanggal, 'd-m-Y') . ' ' . $sesi->start . ':00');
        
        // Check if start time passed

        if(!$dimulai->isPast()) 
        {
            return redirect()->route('ujian.persiapan')
                    ->withErrors('Ujian belum dimulai');

        }

        $sesiBerakhir = Carbon::parse($sesi->end);


        if($sesiBerakhir->isPast()) 
        {
            return redirect()->route('ujian.selesai', ['endtoken' => session('endtoken')])
                    ->withErrors('Ujian telah selesai');
        }

        // Check if users already take exams

        $nilai = Nilai::where('murid_id', auth()->user()->murid_id)->where('jadwal_id', $jadwal->id)->count();

        if($nilai) 
        {
            return redirect()->route('ujian.selesai', ['endtoken' => session('endtoken')])
                     ->withErrors('Ujian telah selesai');
        }
        
        // Check token

        if($status->token != null) 
        {
            if(!session()->has('token_ujian')) 
            {
                return abort(403);
            }

    
            return session('token_ujian') == $status->token ? $next($request) : redirect()->route('ujian.persiapan')
                ->withErrors('Token tidak valid');
        }

        // Check exam status

        if($status->status === 'Nonaktif') 
        {
            return redirect()->route('ujian.persiapan')->withErrors('Ujian belum aktif');
        }

        return $next($request);

    }
}
