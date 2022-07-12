<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use App\Logs\LogsTrait;

class Pelaksanaan extends Model
{
    use LogsTrait;

    protected $table = 'pelaksanaan';
    protected $fillable = ['sesi_id', 'murid_id', 'ruangan_id', 'paket_id', 'jadwal_id'];

    protected static $propertyLogsToShow = 'id';

    public function sesi() 
    {
        return $this->belongsTo('App\Models\Sesi');
    }

    public function murid() 
    {
        return $this->belongsTo('App\Models\Murid');
    }

    public function ruangan() 
    {
        return $this->belongsTo('App\Models\Ruangan');
    }

    public function paket() 
    {
        return $this->belongsTo('App\Models\Paket');
    }

    public function jadwal() 
    {
        return $this->belongsTo('App\Models\Jadwal');
    }

    public function scopeWithAll($query) 
    {
        return $query->with([
            'sesi' => function($query) {
                return $query->select('id', 'nama');
            }, 
            'ruangan' => function($query) {
                return $query->select('id', 'nama');
            }, 
            'murid' => function($query) {
                return $query->select('id', 'nama');
            }, 
            'paket' => function($query) {
                return $query->select('id', 'kode_soal');
            }, 
            'jadwal' => function($query) {
                return $query->select('id', 'nama', 'matapelajaran_id');
            },
            'jadwal.matapelajaran' => function($query) {
                return $query->select('id', 'nama');
            }
        ]);
    }
}
