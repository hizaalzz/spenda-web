<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use App\Models\Permission;

class PermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // 1.Buat 2.LihatSemua 3.delete 4.Edit 

        $permission = new Permission();
        $permission->name = 'Buat Entitas';
        $permission->slug = 'buat-entitas';

        $permission->save();

        $permission = new Permission();
        $permission->name = 'Lihat Semua Entitas';
        $permission->slug = 'lihat-semua-entitas';

        $permission->save();

        $permission = new Permission();
        $permission->name = 'Lihat Entitas';
        $permission->slug = 'lihat-entitas';

        $permission->save();

        $permission = new Permission();
        $permission->name = 'Edit Entitas';
        $permission->slug = 'edit-entitas';

        $permission->save();

        $permission = new Permission();
        $permission->name = 'Hapus Entitas';
        $permission->slug = 'hapus-entitas';

        $permission->save();

        // Core

        $permission = new Permission();
        $permission->name = 'Lihat Nilai';
        $permission->slug = 'lihat-nilai';

        $permission->save();

        $permission = new Permission();
        $permission->name = 'Edit Nilai';
        $permission->slug = 'edit-nilai';

        $permission->save();

        $permission = new Permission();
        $permission->name = 'Aktivasi Ujian';
        $permission->slug = 'aktivasi-ujian';

        $permission->save();

        $permission = new Permission();
        $permission->name = 'Buat Soal';
        $permission->slug = 'buat-soal';

        $permission->save();

        $permission = new Permission();
        $permission->name = 'Edit Soal';
        $permission->slug = 'edit-soal';

        $permission->save();

        $permission = new Permission();
        $permission->name = 'Hapus Soal';
        $permission->slug = 'hapus-soal';

        $permission->save();

        $permission = new Permission();
        $permission->name = 'Atur Pelaksanaan';
        $permission->slug = 'atur-pelaksanaan';

        $permission->save();

        // Log Permission

        $permission = new Permission();
        $permission->name = 'Hapus Log';
        $permission->slug = 'hapus-log';

        $permission->save();
    }
}
