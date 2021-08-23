<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SalesianExperienceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('salesian_experiences')->insert([

            [
                'name_event' => 'Titulo del evento de experiencia salesiana 1',
                'description' => 'Descripcion del evento experiencia salesiana 1, Lorem ipsum dolor sit amet consectetur adipisicing elit. Saepe dolores, voluptate mollitia dolorem praesentium suscipit maxime molestiae cumque id sapiente asperiores repellat? Accusantium eveniet cumque nisi neque id, maxime aliquid!',
                'date' => '2021-08-20',
                'place' => 'Instituto Tecnico Ricaldone',
                'image' => 'url1',
                'type' => 'Coro',
            ],

            [
                'name_event' => 'Titulo del evento de experiencia salesiana 2',
                'description' => 'Descripcion del evento experiencia salesiana 2, Lorem ipsum dolor sit amet consectetur adipisicing elit. Saepe dolores, voluptate mollitia dolorem praesentium suscipit maxime molestiae cumque id sapiente asperiores repellat? Accusantium eveniet cumque nisi neque id, maxime aliquid!',
                'date' => '2021-08-20',
                'place' => 'Instituto Tecnico Ricaldone',
                'image' => 'url2',
                'type' => 'Orquesta',
            ],

            [
                'name_event' => 'Titulo del evento de experiencia salesiana 3',
                'description' => 'Descripcion del evento experiencia salesiana 3, Lorem ipsum dolor sit amet consectetur adipisicing elit. Saepe dolores, voluptate mollitia dolorem praesentium suscipit maxime molestiae cumque id sapiente asperiores repellat? Accusantium eveniet cumque nisi neque id, maxime aliquid!',
                'date' => '2021-08-20',
                'place' => 'Instituto Tecnico Ricaldone',
                'image' => 'url3',
                'type' => 'Selecciones deportivas',
            ],

            [
                'name_event' => 'Titulo del evento de experiencia salesiana 4',
                'description' => 'Descripcion del evento experiencia salesiana 4, Lorem ipsum dolor sit amet consectetur adipisicing elit. Saepe dolores, voluptate mollitia dolorem praesentium suscipit maxime molestiae cumque id sapiente asperiores repellat? Accusantium eveniet cumque nisi neque id, maxime aliquid!',
                'date' => '2021-08-20',
                'place' => 'Instituto Tecnico Ricaldone',
                'image' => 'url4',
                'type' => 'Coreografia',
            ],

            [
                'name_event' => 'Titulo del evento de experiencia salesiana 5',
                'description' => 'Descripcion del evento experiencia salesiana 5, Lorem ipsum dolor sit amet consectetur adipisicing elit. Saepe dolores, voluptate mollitia dolorem praesentium suscipit maxime molestiae cumque id sapiente asperiores repellat? Accusantium eveniet cumque nisi neque id, maxime aliquid!',
                'date' => '2021-08-20',
                'place' => 'Instituto Tecnico Ricaldone',
                'image' => 'url5',
                'type' => 'Oratorio',
            ],

            [
                'name_event' => 'Titulo del evento de experiencia salesiana 6',
                'description' => 'Descripcion del evento experiencia salesiana 6, Lorem ipsum dolor sit amet consectetur adipisicing elit. Saepe dolores, voluptate mollitia dolorem praesentium suscipit maxime molestiae cumque id sapiente asperiores repellat? Accusantium eveniet cumque nisi neque id, maxime aliquid!',
                'date' => '2021-08-20',
                'place' => 'Instituto Tecnico Ricaldone',
                'image' => 'url6',
                'type' => 'Coro',
            ],

        ]);
    }
}
