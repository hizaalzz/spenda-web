<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use App\Logs\LogsTrait;
use Carbon\Carbon;

class JenisUjian extends Model
{
    use LogsTrait;

    protected $table = 'jenis_ujian';

    protected $fillable = ['nama'];
    
    protected static $propertyLogsToShow = 'nama';

    public function setNamaAttribute($value)
    {
        $this->attributes['nama'] = strtoupper($value);
    }

    public function getCreatedAtAttribute($value) 
    {
        return Carbon::parse($value)->format('d-m-Y H:i');
    }

    public function jadwal() 
    {
        return $this->hasMany('App\Models\Jadwal');
    }
}