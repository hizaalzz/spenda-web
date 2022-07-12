<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use App\Models\Sesi;

class SesiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $sesi = new Sesi();

        $sesi->nama = "Sesi 1";
        $sesi->start = "10:00";
        $sesi->end = "12:30";

        $sesi->save();
    }
}
