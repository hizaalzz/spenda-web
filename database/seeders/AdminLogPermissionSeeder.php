<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use App\Models\Admin;
use App\Models\Permission;

class AdminLogPermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = Admin::where('email', 'admin@gmail.com')->first();

        $admin->givePermissionsTo('hapus-log');
    }
}
