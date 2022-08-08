<?php 

namespace App\Helpers;

use App\Models\Jadwal;
use App\Models\Sesi;

class ActiveStatusHelper {

    //aktivasi jadwal
    public static function getActiveJadwal($kelas = null) 
    {
        $jadwal = new Jadwal();

        return $jadwal->getActiveJadwal($kelas ?? auth()->user()->murid->kelas_id)->first();
    }

    //murid session
    public static function getMuridSession($murid = null) 
    {
        $sesi = new Sesi();

        return $sesi->getMySession($murid ?? auth()->user()->murid_id)->first();
    }

    //generate token untuk ujian
    public static function generateToken($length = 5)
    {
        $characters = '0123456789ABCDEFGHIJKLMNOPQRSUVWXYZ';
        $token = '';

        for($i = 0; $i < $length; $i++) 
        {
            $token .= $characters[rand(0, strlen($characters) - 1)];
        }

        return $token;
    }
}