<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateActivitesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('activites', function (Blueprint $table) {

            $table->increments('ID');
            $table->string('Titre', 100);
            $table->float('Prix');
            $table->string('Description', 1024);
            $table->date('Date_realisation');
            $table->date('Date_creation');

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
        Schema::dropIfExists('activites');
    }
}
