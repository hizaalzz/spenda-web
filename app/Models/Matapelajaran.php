<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use App\Logs\LogsTrait;

class Matapelajaran extends Model
{
    use LogsTrait;

    protected $table = 'matapelajaran';
    protected $guarded = [];

    protected static $propertyLogsToShow = 'nama';

    
    public function jurusan() 
    {
        return $this->belongsToMany('App\Models\Jurusan');
    }

    public function jadwal() 
    {
        return $this->hasMany('App\Models\Jadwal');
    }

    public function kelas() 
    {
        return $this->hasMany('App\Models\Kelas');
    }

    public function guru() 
    {
        return $this->belongsToMany('App\Models\Guru');
    }
}
