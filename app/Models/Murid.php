<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Carbon\Carbon;
use App\Logs\LogsTrait;
use App\Classes\GenerateCredential;

class Murid extends Model
{
    use LogsTrait;

    protected static $propertyLogsToShow = 'nama';

    protected $table = 'murid';
    protected $fillable = ['nama', 'nisn', 'nis', 'jenis_kelamin', 'tempat_lahir', 'tanggal_lahir', 'telp'];

    public static function boot() 
    {
        parent::boot();

        self::created(function($model) {
            $credentialGenerator = new GenerateCredential();

            $credentialGenerator->generateUser($model);
        });
    }

    public function user()
    {
        return $this->hasOne('App\Models\User');
    }

    public function setTanggalLahirAttribute($value) 
    {
        $this->attributes['tanggal_lahir'] = Carbon::parse($value)->format('Y-m-d');
    }

    public function kelas() 
    {
        return $this->belongsTo('App\Models\Kelas');
    }

    public function pelaksanaan() 
    {
        return $this->hasMany('App\Models\Pelaksanaan');
    }

    public function jawaban() 
    {
        return $this->hasMany('App\Models\Jawaban');
    }
    
    public function nilai() 
    {
        return $this->hasMany('App\Models\Nilai');
    }
}
