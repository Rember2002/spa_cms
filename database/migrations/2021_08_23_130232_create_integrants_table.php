<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIntegrantsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('integrants', function (Blueprint $table) {
            $table->id();
            $table->string('name_integrant', 255)->unique();
            $table->string('image', 255);
            $table->unsignedBigInteger('id_comission');
            $table->foreign('id_comission')
                ->references('id')
                ->on('commisions');
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
        Schema::dropIfExists('integrants');
    }
}
