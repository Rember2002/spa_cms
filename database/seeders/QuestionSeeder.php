<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class QuestionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('questions')->insert([

            [
                'question' => 'Pregunta frecuente numero 1 Lorem, ipsum dolor sit amet consectetur adipisicing elit. Earum sit assumenda debitis commodi voluptatibus explicabo cupiditate impedit at dolore deleniti nihil, ea officiis vitae autem molestiae quae fugiat saepe ratione.',
                'answer' => 'Respuesta  de pregunta frecuente numero 1 Lorem, ipsum dolor sit amet consectetur adipisicing elit. Earum sit assumenda debitis commodi voluptatibus explicabo cupiditate impedit at dolore deleniti nihil, ea officiis vitae autem molestiae quae fugiat saepe ratione.', 
            ],

            [
                'question' => 'Pregunta frecuente numero 2 Lorem, ipsum dolor sit amet consectetur adipisicing elit. Earum sit assumenda debitis commodi voluptatibus explicabo cupiditate impedit at dolore deleniti nihil, ea officiis vitae autem molestiae quae fugiat saepe ratione.',
                'answer' => 'Respuesta  de pregunta frecuente numero 2 Lorem, ipsum dolor sit amet consectetur adipisicing elit. Earum sit assumenda debitis commodi voluptatibus explicabo cupiditate impedit at dolore deleniti nihil, ea officiis vitae autem molestiae quae fugiat saepe ratione.', 
            ],

            [
                'question' => 'Pregunta frecuente numero 3 Lorem, ipsum dolor sit amet consectetur adipisicing elit. Earum sit assumenda debitis commodi voluptatibus explicabo cupiditate impedit at dolore deleniti nihil, ea officiis vitae autem molestiae quae fugiat saepe ratione.',
                'answer' => 'Respuesta  de pregunta frecuente numero 3 Lorem, ipsum dolor sit amet consectetur adipisicing elit. Earum sit assumenda debitis commodi voluptatibus explicabo cupiditate impedit at dolore deleniti nihil, ea officiis vitae autem molestiae quae fugiat saepe ratione.', 
            ],

            [
                'question' => 'Pregunta frecuente numero 4 Lorem, ipsum dolor sit amet consectetur adipisicing elit. Earum sit assumenda debitis commodi voluptatibus explicabo cupiditate impedit at dolore deleniti nihil, ea officiis vitae autem molestiae quae fugiat saepe ratione.',
                'answer' => 'Respuesta  de pregunta frecuente numero 4 Lorem, ipsum dolor sit amet consectetur adipisicing elit. Earum sit assumenda debitis commodi voluptatibus explicabo cupiditate impedit at dolore deleniti nihil, ea officiis vitae autem molestiae quae fugiat saepe ratione.', 
            ],

            [
                'question' => 'Pregunta frecuente numero 5 Lorem, ipsum dolor sit amet consectetur adipisicing elit. Earum sit assumenda debitis commodi voluptatibus explicabo cupiditate impedit at dolore deleniti nihil, ea officiis vitae autem molestiae quae fugiat saepe ratione.',
                'answer' => 'Respuesta  de pregunta frecuente numero 5 Lorem, ipsum dolor sit amet consectetur adipisicing elit. Earum sit assumenda debitis commodi voluptatibus explicabo cupiditate impedit at dolore deleniti nihil, ea officiis vitae autem molestiae quae fugiat saepe ratione.', 
            ],

        ]);
    }
}
