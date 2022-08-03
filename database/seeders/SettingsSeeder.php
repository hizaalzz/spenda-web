<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use Illuminate\Support\Facades\DB;

class SettingsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tata_tertib = '<ol>
        <li>Siswa dipersilahkan hadir 15 menit sebelum ujian dimulai.</li>
        <li>Siswa dipersilahkan mengisi daftar hadir sebelum ujian dimulai</li>
        <li>Siswa yang dapat mengikuti ujian adalah Siswa yang telah mengisi daftar hadir diawal kedatangan</li>
        <li>Setelah waktu ujian selesai, Siswa harus melakukan logout</li>
        </ol>
        <p><br></p>';

        DB::table('settings')->insert(['key' => 'tata_tertib', 'content' => $tata_tertib]);
    }
}
