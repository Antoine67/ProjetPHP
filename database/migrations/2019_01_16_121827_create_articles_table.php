<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateArticlesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('articles', function (Blueprint $table) {
            $table->increments('ID');
            $table->string('Nom', 100);
            $table->string('Description', 256);
            $table->float('Prix');
            $table->unsignedInteger('Stock');
            $table->binary('Image');
            $table->unsignedInteger('Vendu');
            $table->unsignedInteger('VenduMois');

            $table->unsignedInteger('ID_Paniers');

            //Clés étrangères
            $table->foreign('ID_Paniers')
                ->references('ID')
                ->on('Paniers')
                ->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('articles');
    }
}
