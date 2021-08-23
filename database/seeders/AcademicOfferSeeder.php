<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AcademicOfferSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('academic_offers')->insert([

            [
                'name_offer' => 'Tercer Ciclo',
                'description' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Et sapiente pariatur officiis corporis molestiae dolore voluptas eius amet voluptate est consequuntur officia vero ab aliquam ullam rem perspiciatis, quis soluta!',
                'image' => 'url',
            ],

            [
                'name_offer' => 'Bachillerato',
                'description' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Et sapiente pariatur officiis corporis molestiae dolore voluptas eius amet voluptate est consequuntur officia vero ab aliquam ullam rem perspiciatis, quis soluta!',
                'image' => 'url',
            ],

            [
                'name_offer' => 'PILET',
                'description' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Et sapiente pariatur officiis corporis molestiae dolore voluptas eius amet voluptate est consequuntur officia vero ab aliquam ullam rem perspiciatis, quis soluta!',
                'image' => 'url',
            ],

        ]);
    }
}
