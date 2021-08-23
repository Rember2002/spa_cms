<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CarouselSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('carousels')->insert([

            [
                'name' => 'Bienvenido a el Ricaldone, la casa de la Alegria.',
                'image' => 'url'
            ],

            [
                'name' => '¿Quieres formar parte de la experiencia salesiana?',
                'image' => 'url'
            ],

            [
                'name' => 'Se parte de la familia de la Alegria.',
                'image' => 'url'
            ],

            [
                'name' => 'Conoce nuestra oferta academica.',
                'image' => 'url'
            ],

            [
                'name' => 'Descubre mas sobre nosotros',
                'image' => 'url'
            ],

        ]);
    }
}
