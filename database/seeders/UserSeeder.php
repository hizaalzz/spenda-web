<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use App\Models\Murid;
use App\Models\User;
use Carbon\Carbon;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Murid::create([
            'nama' => 'Murid',
            'nisn' => '1122334455',
            'nis' => '1903044',
            'jenis_kelamin' => 'P',
            'tempat_lahir' => 'Cirebon',
            'tanggal_lahir' => Carbon::now(),
            'telp' => '0212212201',
        ]); 
    }
}
