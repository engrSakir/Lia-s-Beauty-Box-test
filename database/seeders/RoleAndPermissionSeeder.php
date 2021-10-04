<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleAndPermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Role::create(['name' => 'Admin']);
        Role::create(['name' => 'Employee']);
        Role::create(['name' => 'Customer']);
        Permission::create(['name' => 'Invoice create with vat permission']);
        Permission::create(['name' => 'Total vat amount visibility permission']);
    }
}
