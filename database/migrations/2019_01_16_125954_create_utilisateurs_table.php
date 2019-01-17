<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUtilisateursTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('utilisateurs', function (Blueprint $table) {
            $table->increments('ID');
            $table->string('Nom', 100);
            $table->string('Prenom', 100);
            $table->string('Motdepasse', 100);
            $table->string('Email', 100);
            $table->string('Localisation', 100);
            $table->string('Role', 100);
            $table->unique(['Email']);

            $table->unsignedInteger('ID_Paniers');
            $table->unsignedInteger('ID_Role');

            //Clés étrangères
            $table->foreign('ID_Paniers')
                ->references('ID')
                ->on('Paniers')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->foreign('ID_Role')
                ->references('ID')
                ->on('Roles')
                ->onUpdate('cascade')
                ->onDelete('cascade');


        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('utilisateurs');
    }
}
