<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use App\Logs\LogsTrait;

class Jurusan extends Model
{
    use LogsTrait;
    
    protected $table = 'jurusan';
    protected $guarded = [];

    protected static $propertyLogsToShow = 'nama';

    public function matapelajaran() 
    {
        return $this->belongsToMany('App\Models\Matapelajaran');
    }

    public function kelas()
    {
        return $this->hasMany('App\Models\Kelas');
    }

    public function banksoal() 
    {
        return $this->hasMany('App\Models\BankSoal');
    }
}
