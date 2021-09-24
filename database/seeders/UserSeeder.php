<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Admin
        $user = new User();
        $user->name = 'Admin';
        $user->email = 'admin@gmail.com';
        $user->password = bcrypt('password');
        $user->save();
        $user->assignRole('Admin');

        //Employee
        $user = new User();
        $user->name = 'Employee';
        $user->email = 'employee@gmail.com';
        $user->password = bcrypt('password');
        $user->save();
        $user->assignRole('Employee');

        //Customer
        $user = new User();
        $user->name = 'Customer';
        $user->email = 'customer@gmail.com';
        $user->password = bcrypt('password');
        $user->save();
        $user->assignRole('Customer');
    }
}
