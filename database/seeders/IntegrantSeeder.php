<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class IntegrantSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('integrants')->insert([

            [
                'name_integrant' => 'Nombre Integrante 1',
                'image' => 'url/rostro1',
                'id_commission' => 4,
            ],

            [
                'name_integrant' => 'Nombre Integrante 2',
                'image' => 'url/rostro2',
                'id_commission' => 4,
            ],

            [
                'name_integrant' => 'Nombre Integrante 3',
                'image' => 'url/rostro3',
                'id_commission' => 4,
            ],

            [
                'name_integrant' => 'Nombre Integrante 4',
                'image' => 'url/rostro1',
                'id_commission' => 5,
            ],

            [
                'name_integrant' => 'Nombre Integrante 5',
                'image' => 'url/rostro2',
                'id_commission' => 5,
            ],

            [
                'name_integrant' => 'Nombre Integrante 6',
                'image' => 'url/rostro3',
                'id_commission' => 5,
            ],

            [
                'name_integrant' => 'Nombre Integrante 7',
                'image' => 'url/rostro1',
                'id_commission' => 6,
            ],

            [
                'name_integrant' => 'Nombre Integrante 8',
                'image' => 'url/rostro2',
                'id_commission' => 6,
            ],

            [
                'name_integrant' => 'Nombre Integrante 9',
                'image' => 'url/rostro3',
                'id_commission' => 6,
            ],

        ]);
    }
}
