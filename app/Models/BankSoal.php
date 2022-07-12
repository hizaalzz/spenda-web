<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use App\Logs\LogsTrait;

class BankSoal extends Model
{
    use LogsTrait;
    
    protected $table = 'bank_soal';

    protected static $propertyLogsToShow = 'id';

    protected $fillable = ['level_id', 'matapelajaran_id', 'jurusan_id', 'guru_id', 'opsi_pg', 'status'];

    public function jadwal() 
    {
        return $this->hasMany('App\Models\Jadwal');
    }

    public function soal() 
    {
        return $this->hasMany('App\Models\Soal');
    }

    public function level()
    {
        return $this->belongsTo('App\Models\Level');
    }

    public function matapelajaran() 
    {
        return $this->belongsTo('App\Models\Matapelajaran');
    }

    public function jurusan() 
    {
        return $this->belongsTo('App\Models\Jurusan');
    }

    public function guru() 
    {
        return $this->belongsTo('App\Models\Guru');
    }

    public function scopeWhereActive($query)
    {
        return $query->where('status', 'Aktif');
    }
}
