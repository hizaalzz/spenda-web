<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use Carbon\Carbon;
use App\Models\Admin;
use App\Models\Guru;
use App\Models\Role;
use App\Classes\GenerateCredential;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $adminGenerator = new GenerateCredential();

        // Create superadmin

        $guru = new Guru();

        $guru->nama = 'Admin';
        $guru->nuptk = '';
        $guru->email = 'admin@gmail.com';
        $guru->jenis_kelamin = 'L';
        $guru->tempat_lahir = 'Cirebon';
        $guru->tanggal_lahir = Carbon::now();
        $guru-> telp = '';

        if($guru->save()) $adminGenerator->generateAdmin($guru, true,'admin123');
        

        // Create guru

        $guru = new Guru();

        $guru->nama = 'Guru';
        $guru->nuptk = '123456789';
        $guru->email = 'guru@gmail.com';
        $guru->jenis_kelamin = 'L';
        $guru->tempat_lahir = 'Cirebon';
        $guru->tanggal_lahir = Carbon::now();
        $guru->telp = '021221100';

        if($guru->save()) $adminGenerator->generateAdmin($guru, false,'guru123');
    }
}
