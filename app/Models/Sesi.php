<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use App\Logs\LogsTrait;
use Carbon\Carbon;

class Sesi extends Model
{
    use LogsTrait;
    
    protected $table = 'sesi';
    protected $fillable = ['nama', 'start', 'end'];

    protected static $propertyLogsToShow = 'nama';

    public function pelaksanaan() 
    {
        return $this->hasMany('App\Models\Pelaksanaan');
    }

    public function setStartAttribute($value) 
    {
        return $this->attributes['start'] = Carbon::parse($value)->format('H:i');
    }

    public function getStartAttribute($value) 
    {
        return Carbon::parse($value)->format('H:i');
    }

    public function setEndAttribute($value) 
    {
        return $this->attributes['end'] = Carbon::parse($value)->format('H:i');
    }

    public function getEndAttribute($value) 
    {
        return Carbon::parse($value)->format('H:i');
    }

    public function scopeGetMySession($query, $murid = null) 
    {
        return $query->whereHas('pelaksanaan', function($q) use($murid) {
            $q->where('murid_id', $murid ?? auth()->user()->murid_id);
        });
    }

    public function status() 
    {
        return $this->hasMany('App\Models\Status');
    }
}
