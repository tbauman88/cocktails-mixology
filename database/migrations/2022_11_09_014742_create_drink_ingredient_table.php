<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDrinkIngredientTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('drink_ingredient', function (Blueprint $table) {
            $table->id();
            $table->tinyText('amount');
            $table->tinyText('amount_unit');

            $table->unsignedBigInteger('drink_id');
            $table->foreign('drink_id')->references('id')->on('drinks');
            $table->unsignedBigInteger('ingredient_id');
            $table->foreign('ingredient_id')->references('id')->on('ingredients');

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
        Schema::dropIfExists('drink_ingredient');
    }
}
