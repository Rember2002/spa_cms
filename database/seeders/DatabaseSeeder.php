<?php

namespace Database\Seeders;

use App\Models\ContactUs;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        $this->call(AboutUsSeeder::class);

        $this->call(AcademicOfferSeeder::class);

        $this->call(CarouselSeeder::class);

        $this->call(CommissionSeeder::class);

        $this->call(ContactUs::class);

        $this->call(GradeSeeder::class);

        $this->call(IntegrantSeeder::class);

        $this->call(NewHomeSeeder::class);

        $this->call(NewItemSeeder::class);

        $this->call(QuestionSeeder::class);

        $this->call(ResourceSeeder::class);

        $this->call(SalesianExperienceHomeSeeder::class);

        $this->call(SalesianExperienceSeeder::class);

        $this->call(ServiceHomeSeeder::class);

        $this->call(ServiceSeeder::class);

        $this->call(StrategicAllieSeeder::class);

        $this->call(StudentCouncilSeeder::class);
    }
}
