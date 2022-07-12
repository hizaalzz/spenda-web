<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use App\Logs\LogsTrait;
use App\Permissions\HasPermissionsTrait;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Admin extends Authenticatable
{
    use Notifiable, HasPermissionsTrait, LogsTrait;

    protected static $propertyLogsToShow = 'nama';

    public static function boot() 
    {
        parent::boot();

        self::created(function($model) {
            if($model->superadmin) {
                $adminRole = Role::where('slug', 'admin')->first();

                $model->roles()->attach($adminRole);
            } else {
                $guruRole = Role::where('slug', 'guru')->first();

                $model->roles()->attach($guruRole);
            }
        });
    }

    protected $fillable = [
        'nama', 'nig', 'guru_id'
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function guru() 
    {
        return $this->belongsTo('App\Models\Guru');
    }

    public function scopeGetUsername($query, $value, $propertyName)
    {
        $query->where($propertyName, $value)->select('nama');
    }
}
