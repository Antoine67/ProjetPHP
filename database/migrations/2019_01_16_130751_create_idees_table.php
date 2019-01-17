<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateIdeesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('idees', function (Blueprint $table) {
            $table->increments('ID');
            $table->string('Titre', 100);
            $table->string('Contenu', 256);
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
        Schema::dropIfExists('idees');
    }
}
