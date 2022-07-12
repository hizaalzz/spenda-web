<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use App\Models\BankSoal;

class BankSoalSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $banksoal = new BankSoal();

        $banksoal->opsi_pg = 4;
        $banksoal->level_id = 1;
        $banksoal->jurusan_id = 1;
        $banksoal->matapelajaran_id = 1;
        $banksoal->guru_id = 2;
        $banksoal->status = 'Aktif';

        $banksoal->save();
    }
}
