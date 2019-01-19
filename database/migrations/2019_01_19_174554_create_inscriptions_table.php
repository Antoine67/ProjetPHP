<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInscriptionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inscriptions', function (Blueprint $table) {

            $table->increments('ID');
            $table->date('Date_inscription');

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
        Schema::dropIfExists('inscriptions');
    }
}
