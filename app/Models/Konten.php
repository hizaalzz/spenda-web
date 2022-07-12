<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use App\Logs\LogsTrait;

class Konten extends Model
{
    use LogsTrait;
    
    protected static $propertyLogsToShow = 'id';

    protected $table = 'konten';

    public function soal() 
    {
        return $this->belongsTo('App\Models\Soal');
    }
}
