<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use App\Logs\LogsTrait;

class Kelas extends Model
{
    use LogsTrait;
    
    protected $table = 'kelas';
    protected $fillable = ['nama_kelas', 'level_id', 'jurusan_id'];

    protected static $propertyLogsToShow = 'nama_kelas';

    public function level() 
    {
        return $this->belongsTo('App\Models\Level');
    }

    public function murid() 
    {
        return $this->hasMany('App\Models\Murid');
    }

    public function jurusan() 
    {
        return $this->belongsTo('App\Models\Jurusan');
    }

    public function jadwal() 
    {
        return $this->hasMany('App\Models\Jadwal');
    }
}
