<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNewItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('new_items', function (Blueprint $table) {
            $table->id();
            $table->string('title', 255)->unique();
            $table->longText('content');
            $table->date('date');
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
        Schema::dropIfExists('new_items');
    }
}
