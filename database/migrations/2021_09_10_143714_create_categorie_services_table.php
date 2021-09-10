<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCategorieServicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('categorie_services', function (Blueprint $table) {
            $table->id();
            $table->string('name_categorie', 255)->unique();
            $table->longText('description');
            $table->unsignedBigInteger('id_service');
            $table->foreign('id_service')
                ->references('id')
                ->on('services');
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
        Schema::dropIfExists('categorie_services');
    }
}
