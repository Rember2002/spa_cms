<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCategorieGradesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('categorie_grades', function (Blueprint $table) {
            $table->id();
            $table->string('name_categorie', 255)->unique();
            $table->longText('description');
            $table->unsignedBigInteger('id_grade');
            $table->foreign('id_grade')
                ->references('id')
                ->on('grades');
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
        Schema::dropIfExists('categorie_grades');
    }
}
