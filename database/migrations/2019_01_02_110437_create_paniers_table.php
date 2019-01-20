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

            $table->unsignedInteger('Quantité');
            $table->date('Date_creation');

            $table->unsignedInteger('ID_Utilisateurs');
            $table->unsignedInteger('ID_Articles');

            //Clés étrangères
            $table->foreign('ID_Articles')
                ->references('ID')
                ->on('Articles')
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
        Schema::dropIfExists('paniers');
    }
}
