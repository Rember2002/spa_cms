<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SectionNavBarSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('section_nav_bars')->insert([

            [
                'name_section' => 'Servicios',
                'link' => 'url/Servicios',
            ],

            [
                'name_section' => 'Estudiantes',
                'link' => 'url/Estudiantes',
            ],

            [
                'name_section' => 'Noticias',
                'link' => 'url/Noticias',
            ],

            [
                'name_section' => 'Donaciones',
                'link' => 'url/Donaciones',
            ],

            [
                'name_section' => 'Acerca de',
                'link' => 'url/Acerca de',
            ],

            [
                'name_section' => 'Vivencia Salesiana',
                'link' => 'url/Vivencia Salesiana',
            ],

            [
                'name_section' => 'Oferta Academica',
                'link' => 'url/Oferta Academica',
            ],

            [
                'name_section' => 'Contactenos',
                'link' => 'url/Contactenos',
            ],

            [
                'name_section' => 'Preguntas Frecuentes',
                'link' => 'url/Preguntas Frecuentes',
            ],

        ]);
    }
}
