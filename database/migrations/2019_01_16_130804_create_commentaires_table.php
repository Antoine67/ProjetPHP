<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCommentairesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('commentaires', function (Blueprint $table) {
            $table->increments('id');
            $table->string('Contenu', 256);


            $table->unsignedInteger('ID_Idees');
            $table->unsignedInteger('ID_Utilisateurs');

            //Clés étrangères
            $table->foreign('ID_Idees')
                ->references('ID')
                ->on('Idees')
                ->onUpdate('cascade')
                ->onDelete('cascade');

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
        Schema::dropIfExists('commentaires');
    }
}
