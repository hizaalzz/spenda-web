<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    public function permissions() 
    {
        return $this->belongsToMany('App\Models\Permission');
    }

    public function admin()
    {
        return $this->belongsToMany('App\Models\Admin');
    }
}
