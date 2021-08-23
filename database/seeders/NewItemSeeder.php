<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class NewItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('new_items')->insert([

            [
                'title' => 'Titulo de noticia de prueba 1',
                'content' => 'Contenido de prueba de la noticia 1 Lorem ipsum dolor sit amet consectetur adipisicing elit. Consequuntur mollitia facilis a, totam aliquid, fugiat, iusto saepe quidem officia at reiciendis ex consectetur debitis eos optio numquam quisquam eligendi ipsam.', 
                'date' => '2021-08-23',
            ],

            [
                'title' => 'Titulo de noticia de prueba 2',
                'content' => 'Contenido de prueba de la noticia 2 Lorem ipsum dolor sit amet consectetur adipisicing elit. Consequuntur mollitia facilis a, totam aliquid, fugiat, iusto saepe quidem officia at reiciendis ex consectetur debitis eos optio numquam quisquam eligendi ipsam.', 
                'date' => '2021-08-23',
            ],

            [
                'title' => 'Titulo de noticia de prueba 3',
                'content' => 'Contenido de prueba de la noticia 3 Lorem ipsum dolor sit amet consectetur adipisicing elit. Consequuntur mollitia facilis a, totam aliquid, fugiat, iusto saepe quidem officia at reiciendis ex consectetur debitis eos optio numquam quisquam eligendi ipsam.', 
                'date' => '2021-08-23',
            ],

        ]);
    }
}
