<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run()
    {
        User::create([
            'name' => 'Admin',
            'email' => 'admin@test.com',
            'password' => Hash::make('12345678'),
            'role_id' => 1,
            'is_active' => true,
        ]);

        User::create([
            'name' => 'Ventas',
            'email' => 'sales@test.com',
            'password' => Hash::make('12345678'),
            'role_id' => 2,
            'is_active' => true,
        ]);

        User::create([
            'name' => 'Repartidor',
            'email' => 'route@test.com',
            'password' => Hash::make('12345678'),
            'role_id' => 4,
            'is_active' => true,
        ]);
    }
}