<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use App\Logs\LogsTrait;

class Ruangan extends Model
{
    use LogsTrait;
    
    protected $table = 'ruangan';
    protected $fillable = ['nama'];

    protected static $propertyLogsToShow = 'nama';

    public function pelaksanaan() 
    {
        return $this->hasMany('App\Models\Pelaksanaan');
    }
}
