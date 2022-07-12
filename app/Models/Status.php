<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use App\Logs\LogsTrait;

class Status extends Model
{
    use LogsTrait;
    
    protected $table = 'status';
    protected $fillable = ['jadwal_id', 'status', 'token', 'sesi_id'];

    protected static $propertyLogsToShow = 'id';

    public function jadwal() 
    {
        return $this->belongsTo('App\Models\Jadwal');
    }

    public function scopeWhereActive($query)
    {
        return $query->where('status', 'Aktif')->orderBy('sesi_id');
    }

    public function scopeWhereNonActive($query)
    {
        return $query->where('status', 'Nonaktif')->orderBy('sesi_id');
    }

    public function sesi() 
    {
        return $this->belongsTo('App\Models\Sesi');
    }
}
