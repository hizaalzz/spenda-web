<?php 

namespace App\Classes;

use App\Models\Admin;
use App\Models\User;
use Carbon\Carbon;

class GenerateCredential {

    public function generateUser($model) 
    {
        $user = new User();
      
        $user->nama = $model->nama;
        $user->nis = $model->nis;
        $user->murid_id = $model->id;

        $tanggal_lahir = Carbon::parse($model->tanggal_lahir)->format('d-m-Y');
        $password = str_replace('-', '', $tanggal_lahir);

        // $user->password = bcrypt($password);
        $user->password = bcrypt('user123');

        $user->save();

    }
    
    public function generateAdmin($model, $superadmin = false, $customPassword = null) 
    {
        $admin = new Admin();

        $admin->nama = $model->nama;
        $admin->email = $model->email;

        if($customPassword !== null) {
            $admin->password = bcrypt('guru123');
        } else {
            
            $admin->password = bcrypt('guru123');
        }

        $admin->superadmin = $superadmin;
        $admin->guru_id = $model->id;

        $admin->save();
    }
}