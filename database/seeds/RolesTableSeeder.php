<?php

use Illuminate\Database\Seeder;
use App\Role;
use App\User;
class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Role::create([
            'id'          => 1,
            'code'        => 'ADMIN',
            'name'        => 'Administrator',
        ]);
        Role::create([
            'id'          => 2,
            'code'        => 'MANAGER',
            'name'        => 'Manager',
        ]);
        Role::create([
            'id'          => 3,
            'code'        => 'CUSTOMER',
            'name'        => 'Customer',
        ]);
        Role::create([
            'id'          => 4,
            'code'        => 'DRIVER',
            'name'        => 'Driver',
        ]);

        User::create([
            'name'       => 'Administrator',
            'email'      => 'tisho26bg@gmail.com',
            'password'   => bcrypt('123456'),
            'role_id'    => 1,
        ]);
    }
}
