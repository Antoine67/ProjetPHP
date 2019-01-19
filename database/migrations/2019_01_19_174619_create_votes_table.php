<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVotesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('votes', function (Blueprint $table) {

            $table->increments('ID');

            $table->unsignedInteger('ID_Utilisateurs');
            $table->unsignedInteger('ID_Idees');

            //Clés étrangères
            $table->foreign('ID_Idees')
                ->references('ID')
                ->on('Idees')
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
        Schema::dropIfExists('votes');
    }
}
