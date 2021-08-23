<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StrategicAllieSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('strategic_allies')->insert([

            [
                'name_ally' => 'Insaforp',
                'image' => 'Logo Insaforp',
                'description' => 'Objetivo y descripcion de la Alianza con Insaforp, Lorem ipsum dolor sit amet consectetur adipisicing elit. Mollitia nobis assumenda, numquam accusamus id minus doloribus itaque incidunt ea necessitatibus reprehenderit praesentium harum quod maxime quibusdam! Distinctio molestias cumque eum.',
            ],

            [
                'name_ally' => 'Fundacion Eugenia de Siman',
                'image' => 'Logo Fundacion Eugenia de Siman',
                'description' => 'Objetivo y descripcion de la Alianza con Fundacion Eugenia de Siman, Lorem ipsum dolor sit amet consectetur adipisicing elit. Mollitia nobis assumenda, numquam accusamus id minus doloribus itaque incidunt ea necessitatibus reprehenderit praesentium harum quod maxime quibusdam! Distinctio molestias cumque eum.',
            ],

            [
                'name_ally' => 'Universidad Don Bosco',
                'image' => 'Logo Universidad Don Bosco',
                'description' => 'Objetivo y descripcion de la Alianza con Universidad Don Bosco, Lorem ipsum dolor sit amet consectetur adipisicing elit. Mollitia nobis assumenda, numquam accusamus id minus doloribus itaque incidunt ea necessitatibus reprehenderit praesentium harum quod maxime quibusdam! Distinctio molestias cumque eum.',
            ],

        ]);
    }
}
