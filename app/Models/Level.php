<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use App\Logs\LogsTrait;

class Level extends Model
{
    use LogsTrait;
    
    protected $fillable = ['nama', 'skala'];

    protected static $propertyLogsToShow = 'nama';

    public function kelas() 
    {
        return $this->hasMany('App\Models\Kelas');
    }
}
