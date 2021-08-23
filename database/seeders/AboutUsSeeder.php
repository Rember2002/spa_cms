<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AboutUsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('about_us')->insert([

            [
                 'name' => 'Mision',
                 'description' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Sequi labore perferendis repudiandae quo alias vel libero, ad dolore unde quis eius nemo minus totam, sed ipsa enim aliquam quod nostrum.',
                 'type' => 'Mission',
                 'year' => 2021,
                 'image' => 'url'
             ],
            
            [
                 'name' => 'Vision',
                 'description' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Sequi labore perferendis repudiandae quo alias vel libero, ad dolore unde quis eius nemo minus totam, sed ipsa enim aliquam quod nostrum.',
                 'type' => 'View',
                 'year' => 2021,
                 'image' => 'url'
             ],
 
             [
                 'name' => 'Respeto',
                 'description' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Sequi labore perferendis repudiandae quo alias vel libero, ad dolore unde quis eius nemo minus totam, sed ipsa enim aliquam quod nostrum.',
                 'type' => 'Value',
                 'year' => 2021,
                 'image' => 'url'
             ],
 
             [
                 'name' => 'Educacion',
                 'description' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Sequi labore perferendis repudiandae quo alias vel libero, ad dolore unde quis eius nemo minus totam, sed ipsa enim aliquam quod nostrum.',
                 'type' => 'Value',
                 'year' => 2021,
                 'image' => 'url'
             ],
 
             [
                 'name' => 'Fe',
                 'description' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Sequi labore perferendis repudiandae quo alias vel libero, ad dolore unde quis eius nemo minus totam, sed ipsa enim aliquam quod nostrum.',
                 'type' => 'Value',
                 'year' => 2021,
                 'image' => 'url'
             ]
 
         ]);
    }
}
