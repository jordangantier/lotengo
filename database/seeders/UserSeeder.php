<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use App\Models\User;

class UserSeeder extends Seeder
{
    public function run()
    {
        User::create([
            'name' => 'Super Administrador',
            'email' => 'jordangantier@gmail.com',
            'password' => bcrypt('12345678'),
        ]);

        User::create([
            'name' => 'Editor',
            'email' => 'jordangantier@live.com',
            'password' => bcrypt('12345678'),
        ]);
    }
}
