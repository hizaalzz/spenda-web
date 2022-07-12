<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use App\Logs\LogsTrait;

class Soal extends Model
{
    use LogsTrait; 

    protected static $propertyLogsToShow = 'id';
    protected static $recordEvents = ['updated', 'deleted'];

    protected $table = 'soal';
    protected $guarded = [];

    public function paket() 
    {
        return $this->belongsTo('App\Models\Paket');
    }

    public function banksoal() 
    {
        return $this->belongsTo('App\Models\BankSoal', 'bank_soal_id');
    }

    public function konten() 
    {
        return $this->hasMany('App\Models\Konten');
    }

    public function scopeExcludeJawaban($query) 
    {
        return $query->select('id', 'paket_id', 'bank_soal_id', 'isi', 'pilA', 'pilB', 'pilC', 'pilD', 'pilE', 'jenis');
    }
}
