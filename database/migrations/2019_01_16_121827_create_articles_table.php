<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateArticlesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('articles', function (Blueprint $table) {

            $table->increments('ID');
            $table->string('Nom', 100);
            $table->string('Description', 512);
            $table->float('Prix');
            $table->unsignedInteger('Stock');
            $table->string('Image',1024);
            $table->unsignedInteger('Vendu');
            $table->string('Categorie', 100);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('articles');
    }
}
