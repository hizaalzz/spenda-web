<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use App\Logs\LogsTrait;

class Nilai extends Model
{
    use LogsTrait;

    protected $table = 'nilai';
    protected $fillable = ['jadwal_id', 'murid_id', 'nilai', 'status'];

    protected static $recordEvents = ['updated'];
    protected static $propertyLogsToShow = 'id';

    public function murid() 
    {
        return $this->belongsTo('App\Models\Murid');
    }

    public function jadwal() 
    {
        return $this->belongsTo('App\Models\Jadwal');
    }
}
