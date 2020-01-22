<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Roles extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('role', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->timestamps();
        });

        Schema::create('userRole', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('idUser')->unsigned();
            $table->integer('idRole')->unsigned();
            $table->foreign('idUser')->references('id')->on('users');
            $table->foreign('idRole')->references('id')->on('role');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
        Schema::dropIfExists('userRole');
        Schema::dropIfExists('role');
    }
}
