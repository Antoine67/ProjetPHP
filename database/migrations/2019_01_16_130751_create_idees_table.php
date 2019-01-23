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
            $table->string('Contenu',1024);
            $table->string('Image',512);
            $table->date('Date_creation');
            $table->unsignedInteger('Etat');

            $table->unsignedInteger('ID_Utilisateurs');
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
