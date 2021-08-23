<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSectionNavBarsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('section_nav_bars', function (Blueprint $table) {
            $table->id();
            $table->string('name_section');
            $table->string('link');
            $table->unsignedBigInteger('id_section_belong')->nullable();
            $table->foreign('id_section_belong')
                ->references('id')
                ->on('section_nav_bars');
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
        Schema::dropIfExists('section_nav_bars');
    }
}
