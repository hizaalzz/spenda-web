<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use App\Models\Admin;
use App\Models\Role;

class GiveRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $adminRole = Role::where('slug', 'admin')->first();
        $guruRole = Role::where('slug', 'guru')->first();

        $superAdminUser = Admin::where('email', 'admin@gmail.com')->first();
        $guruUser = Admin::where('email', 'hendri@gmail.com')->first();

        $superAdminUser->roles()->attach($adminRole);
        $guruUser->roles()->attach($guruRole);
    }
}
