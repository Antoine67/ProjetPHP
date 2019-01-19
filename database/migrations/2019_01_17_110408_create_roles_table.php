<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRolesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('roles', function (Blueprint $table) {

            $table->increments('ID');
            $table->string('Denomination', 100);

            $table->unsignedInteger('Perm_boutique');
            $table->unsignedInteger('Perm_idees');
            $table->unsignedInteger('Perm_activites');
            $table->unsignedInteger('Perm_header');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('roles');
    }
}
