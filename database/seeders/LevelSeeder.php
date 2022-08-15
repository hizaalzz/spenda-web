<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use App\Models\Level;

class LevelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $level1 = new Level();
        $level1->nama = 'Kelas 7';
        $level1->skala = 1;
        $level1->save();

        $level2 = new Level();
        $level2->nama = 'Kelas 8';
        $level2->skala = 2;
        $level2->save();

        $level3 = new Level();
        $level3->nama = 'Kelas 9';
        $level3->skala = 3;
        $level3->save();
    }
}
