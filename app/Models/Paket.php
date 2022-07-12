<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use App\Logs\LogsTrait;

class Paket extends Model
{
    use LogsTrait;
    
    protected $table = 'paket';

    protected $fillable = ['kode_soal'];
    
    protected static $propertyLogsToShow = 'nama';

    public function pelaksanaan() 
    {
        return $this->hasMany('App\Models\Pelaksanaan');
    }
}
