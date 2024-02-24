<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class UserCustomerSeeder extends Seeder
{
    public function run()
    {
        User::create([
            'full_name' => 'Fabian Barria',
            'email' => 'fbarria@ptorepuesto.cl',
            'password' => bcrypt('123456'),
            'role' => 'customer'
        ]);

        User::create([
            'full_name' => 'Diego Barria',
            'email' => 'dbarria@ptorepuesto.cl',
            'password' => bcrypt('123456'),
            'role' => 'customer'
        ]);
    }
}
