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
                'section_nav_bars' => NULL,
            ],

            [
                'name_section' => 'Estudiantes',
                'link' => 'url/Estudiantes',
                'section_nav_bars' => NULL,
            ],

            [
                'name_section' => 'Noticias',
                'link' => 'url/Noticias',
                'section_nav_bars' => NULL,
            ],

            [
                'name_section' => 'Donaciones',
                'link' => 'url/Donaciones',
                'section_nav_bars' => NULL,
            ],

            [
                'name_section' => 'Acerca de',
                'link' => 'url/Acerca de',
                'section_nav_bars' => NULL,
            ],

            [
                'name_section' => 'Vivencia Salesiana',
                'link' => 'url/Vivencia Salesiana',
                'section_nav_bars' => NULL,
            ],

            [
                'name_section' => 'Oferta Academica',
                'link' => 'url/Oferta Academica',
                'section_nav_bars' => NULL,
            ],

            [
                'name_section' => 'Contactenos',
                'link' => 'url/Contactenos',
                'section_nav_bars' => NULL,
            ],

            [
                'name_section' => 'Preguntas Frecuentes',
                'link' => 'url/Preguntas Frecuentes',
                'section_nav_bars' => NULL,
            ],

        ]);
    }
}
