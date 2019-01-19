<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLikesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('likes', function (Blueprint $table) {
           
            $table->increments('ID');
            $table->boolean('Positif');
            
            $table->unsignedInteger('ID_Image_activites');
            $table->unsignedInteger('ID_Utilisateurs');

            //Clés étrangères
            $table->foreign('ID_Image_activites')
                ->references('ID')
                ->on('image_activites')
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
        Schema::dropIfExists('likes');
    }
}
