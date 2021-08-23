<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ServiceHomeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('service_homes')->insert([

            [
                'image' => 'url1',
                'link' => 'url/Service',
            ],

            [
                'image' => 'url2',
                'link' => 'url/Service',
            ],

            [
                'image' => 'url3',
                'link' => 'url/Service',
            ],

            [
                'image' => 'url4',
                'link' => 'url/Service',
            ],

            [
                'image' => 'url5',
                'link' => 'url/Service',
            ],

        ]);
    }
}
