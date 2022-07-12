<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use App\Models\Permission;
use App\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Create roles

        $adminRole = new Role();
        $adminRole->name = 'Admin';
        $adminRole->slug = 'admin';

        $adminRole->save();

        $guruRole = new Role();
        $guruRole->name = 'Guru';
        $guruRole->slug = 'guru';

        $guruRole->save();
    }
}
