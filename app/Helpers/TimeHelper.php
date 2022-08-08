<?php 

namespace App\Helpers;

use Carbon\Carbon;

//pengaturan waktu
class TimeHelper {
    public static function isPassed($timeValue) 
    {
        $tanggal = Carbon::parse($timeValue);

        return $tanggal->isPast();
    }

    public static function convert($value, $format) 
    {
        return Carbon::parse($value)->format($format);
    }
}