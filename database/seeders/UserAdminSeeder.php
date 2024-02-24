<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class UserAdminSeeder extends Seeder
{
    public function run()
    {
        User::create([
            'full_name' => 'Esteban Barria',
            'email' => 'ebarria@ptorepuesto.cl',
            'password' => bcrypt('123456'),
            'role' => 'admin'
        ]);
    }
}
