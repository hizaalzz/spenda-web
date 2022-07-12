<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Carbon\Carbon;

class Jawaban extends Model
{
    protected $table = 'jawaban';
    protected $fillable = ['jadwal_id', 'paket_id', 'murid_id', 'soal_id', 'penilaian_id', 'jawaban', 'ragu', 'status'];

    public function jadwal() 
    {
        return $this->belongsTo('App\Models\Jadwal');
    }

    public function murid() 
    {
        return $this->belongsTo('App\Models\Murid');
    }

    public function soal() 
    {
        return $this->belongsTo('App\Models\Soal');
    }

    public function getCreatedAtAttribute($value) 
    {
        return Carbon::parse($value)->format('d-m-Y H:i');
    }

    public function scopeSearch($query, $murid, $jadwal, $soal) 
    {
        return $query->where('murid_id', $murid)->where('jadwal_id', $jadwal)->where('soal_id', $soal);
    }
}
