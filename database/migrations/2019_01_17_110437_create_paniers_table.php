<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePaniersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('paniers', function (Blueprint $table) {
            $table->increments('ID');


            $table->unsignedInteger('ID_Article');
            $table->unsignedInteger('Quantité');
            $table->date('Date_creation');

            $table->unsignedInteger('ID_Utilisateurs');

            //Clés étrangères
            $table->foreign('ID_Utilisateurs')
                ->references('ID')
                ->on('Utilisateurs')
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
        Schema::dropIfExists('paniers');
    }
}
