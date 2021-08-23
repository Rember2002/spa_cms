<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ResourceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('resources')->insert([

            [
                'name_resource' => 'Recurso disponible 1',
                'description' => 'Descripcion del recurso disponible 1 Lorem ipsum dolor sit amet consectetur adipisicing elit. Quidem et, recusandae culpa excepturi doloribus molestias nemo, quae quos eos pariatur velit perspiciatis fuga adipisci assumenda iure voluptates minus nesciunt saepe.',
                'image' => 'url1'
            ],

            [
                'name_resource' => 'Recurso disponible 2',
                'description' => 'Descripcion del recurso disponible 2 Lorem ipsum dolor sit amet consectetur adipisicing elit. Quidem et, recusandae culpa excepturi doloribus molestias nemo, quae quos eos pariatur velit perspiciatis fuga adipisci assumenda iure voluptates minus nesciunt saepe.',
                'image' => 'url2'
            ],

            [
                'name_resource' => 'Recurso disponible 3',
                'description' => 'Descripcion del recurso disponible 3 Lorem ipsum dolor sit amet consectetur adipisicing elit. Quidem et, recusandae culpa excepturi doloribus molestias nemo, quae quos eos pariatur velit perspiciatis fuga adipisci assumenda iure voluptates minus nesciunt saepe.',
                'image' => 'url3'
            ],

            [
                'name_resource' => 'Recurso disponible 4',
                'description' => 'Descripcion del recurso disponible 4 Lorem ipsum dolor sit amet consectetur adipisicing elit. Quidem et, recusandae culpa excepturi doloribus molestias nemo, quae quos eos pariatur velit perspiciatis fuga adipisci assumenda iure voluptates minus nesciunt saepe.',
                'image' => 'url4'
            ],

            [
                'name_resource' => 'Recurso disponible 5',
                'description' => 'Descripcion del recurso disponible 5 Lorem ipsum dolor sit amet consectetur adipisicing elit. Quidem et, recusandae culpa excepturi doloribus molestias nemo, quae quos eos pariatur velit perspiciatis fuga adipisci assumenda iure voluptates minus nesciunt saepe.',
                'image' => 'url5'
            ],

        ]);
    }
}
