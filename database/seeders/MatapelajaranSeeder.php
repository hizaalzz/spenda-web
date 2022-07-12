<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use App\Models\Matapelajaran;

class MatapelajaranSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            ['nama' => 'IPA'],
            ['nama' => 'IPS'],
            ['nama' => 'Matematika'],
        ];

        Matapelajaran::insert($data);
    }
}
