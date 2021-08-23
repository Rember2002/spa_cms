<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateServiceHomesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('service_homes', function (Blueprint $table) {
            $table->id();
            $table->string('image', 255)->unique();
            $table->string('link', 255);
            $table->enum('state', ['Visible', 'Disabled'])->default('Visible');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('service_homes');
    }
}
