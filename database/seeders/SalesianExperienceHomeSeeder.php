<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SalesianExperienceHomeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('salesian_experience_homes')->insert([

            [
                'image' => 'url1',
                'description' => 'Titulo o descripcion de la imagen de presentacion 1',
                'year' => 2021,
            ],

            [
                'image' => 'url2',
                'description' => 'Titulo o descripcion de la imagen de presentacion 2',
                'year' => 2021,
            ],

            [
                'image' => 'url3',
                'description' => 'Titulo o descripcion de la imagen de presentacion 3',
                'year' => 2021,
            ],

            [
                'image' => 'url4',
                'description' => 'Titulo o descripcion de la imagen de presentacion 4',
                'year' => 2021,
            ],

            [
                'image' => 'url5',
                'description' => 'Titulo o descripcion de la imagen de presentacion 5',
                'year' => 2021,
            ],

        ]);
    }
}
