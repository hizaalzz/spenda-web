<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        $this->call(UserSeeder::class);
        $this->call(MatapelajaranSeeder::class);
        $this->call(JurusanSeeder::class);
        $this->call(LevelSeeder::class);
        $this->call(SesiSeeder::class);
        $this->call(KelasSeeder::class);
        $this->call(SettingsSeeder::class);
        $this->call(PermissionsSeeder::class);
        $this->call(RoleSeeder::class);
        $this->call(AdminSeeder::class);
        $this->call(PermissionRoleSeeder::class);
        $this->call(BankSoalSeeder::class);
        $this->call(JenisUjianSeeder::class);
        $this->call(PaketSeeder::class);
        $this->call(AdminLogPermissionSeeder::class);
    }
}
