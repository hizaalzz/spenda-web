<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use App\Logs\LogsTrait;
use Carbon\Carbon;

class Pengumuman extends Model
{
    use LogsTrait;

    protected $table = 'pengumuman';

    protected static $propertyLogsToShow = 'judul';

    public function getCreatedAtAttribute($value) 
    {
        return Carbon::parse($value)->format('d-m-Y h:i');
    }
}
