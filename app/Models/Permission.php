<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    public function roles() 
    {
        return $this->belongsToMany('App\Models\Role');
    }

    public function admin() 
    {
        return $this->belongsToMany('App\Models\Admin');
    }

    public function scopeWhereSlug($query, $permission)
    {
        return $query->where('slug', $permission)->first();
    } 
}
