<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\CarBrand;
use App\Models\CarModel;

class CarBrandSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $mazda = CarBrand::create([
            'title' => 'Mazda',
            'slug' => 'mazda'
        ]);

        $mazda->models()->createMany([
            [
                'title' => 'MX-5',
                'slug' => 'mx-5'
            ],
            [
                'title' => 'CX-9',
                'slug' => 'cx-9'
            ]
        ]);

        $toyota = CarBrand::create([
            'title' => 'Toyota',
            'slug' => 'toyota'
        ]);

        $toyota->models()->createMany([
            [
                'title' => 'Corolla',
                'slug' => 'corolla'
            ],
            [
                'title' => 'Yaris',
                'slug' => 'yaris'
            ]
        ]);

        $nissan = CarBrand::create([
            'title' => 'Nissan',
            'slug' => 'nissan'
        ]);

        $nissan->models()->createMany([
            [
                'title' => 'Versa',
                'slug' => 'versa'
            ],
            [
                'title' => 'Sentra',
                'slug' => 'sentra'
            ]
        ]);

        $chevrolet = CarBrand::create([
            'title' => 'Chevrolet',
            'slug' => 'chevrolet'
        ]);

        $chevrolet->models()->createMany([
            [
                'title' => 'Sail',
                'slug' => 'sail'
            ],
            [
                'title' => 'Onix',
                'slug' => 'onix'
            ]
        ]);
    }
}
