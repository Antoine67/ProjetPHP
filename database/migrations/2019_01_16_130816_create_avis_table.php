<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAvisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('avis', function (Blueprint $table) {

            $table->increments('ID');
            $table->binary('Contenu');
            $table->date('Date_creation');
        
            $table->unsignedInteger('ID_Utilisateurs');
            $table->unsignedInteger('ID_Activites');

            //Clés étrangères
            $table->foreign('ID_Activites')
                ->references('ID')
                ->on('Activites')
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
        Schema::dropIfExists('avis');
    }
}
