<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Spatie\Permission\Models\Role;

class UsersTableSeeder extends Seeder
{
    public function run()
    {
        // Create admin user
        $admin = User::create([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
            'password' => bcrypt('password'),
        ]);
        $admin->assignRole('admin');

        // Create customer users
        $customerRole = Role::where('name', 'customer')->first();

        for ($i = 1; $i <= 5; $i++) {
            $customer = User::create([
                'name' => 'Customer ' . $i,
                'email' => 'customer' . $i . '@example.com',
                'password' => bcrypt('password'),
            ]);
            $customer->assignRole($customerRole);
        }
    }
}
