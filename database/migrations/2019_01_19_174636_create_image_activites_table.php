<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateImageActivitesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('image_activites', function (Blueprint $table) {
            
            $table->increments('ID');
            $table->string('Image',1024);
            $table->string('Auteur',128);
            $table->boolean('Valide');
            $table->unsignedInteger('ID_Utilisateurs');

            $table->unsignedInteger('ID_Activites');

            //Clés étrangères
            $table->foreign('ID_Activites')
                ->references('ID')
                ->on('Activites')
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
        Schema::dropIfExists('image_activites');
    }
}
