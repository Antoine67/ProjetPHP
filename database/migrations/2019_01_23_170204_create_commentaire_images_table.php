<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCommentaireImagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('commentaire_images', function (Blueprint $table) {
            $table->increments('ID');
            $table->string('Contenu',512);
            $table->unsignedInteger('ID_Utilisateurs');
           
            $table->unsignedInteger('ID_Image_Activites');

            //Clés étrangères
            $table->foreign('ID_Image_Activites')
                ->references('ID')
                ->on('Image_Activites')
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
        Schema::dropIfExists('commentaire_images');
    }
}
