<?php

namespace App\Models;

use Carbon\Carbon;
use Spatie\Activitylog\Models\Activity;

class Logs extends Activity 
{
    public function getCreatedAtAttribute($value) 
    {
        return Carbon::parse($value)->format('d-m-Y h:i:s');
    }
}
