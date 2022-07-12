<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\Jadwal;
use App\Models\Permission;

class PenilaianMiddleware
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
        $user = auth('admin')->user();

        $jadwal = null;

        if($request->route('penilaian') !== null) 
        {
            $jadwal = Jadwal::where('guru_id', auth('admin')->user()->guru_id)
                ->where('kelas_id', $request->route('penilaian'))->first();

        }

        if($jadwal !== null) 
        {
            if($user->hasRole('guru') && $user->guru_id === $jadwal->guru_id) {
                return $next($request);
            }
        }

        if($user->hasRole('admin') || $user->hasRole('guru') ||
            $user->hasPermissionTo(Permission::whereSlug('lihat-semua-entitas'))) {
            return $next($request);

        }

        return abort(403);
    }
}
