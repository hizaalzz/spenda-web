<?php

namespace App\Helpers;

class GivePermissions {
    
    public static function getPermission($userType) 
    {
        if($userType === 'guru') {
            return [
                'buat_soal',
                'edit-soal',
                'hapus-soal',
                'lihat-entitas',
                'lihat-nilai'
            ];
        } else if($userType === 'admin') {
            
        }
    }
}