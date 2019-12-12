<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ProductTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('person', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->timestamps();
        });

        Schema::create('typeProduct', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->timestamps();
        });

        Schema::create('product', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->integer('price');
            $table->integer('idTypeProduct')->unsigned();
            $table->foreign('idTypeProduct')
                 ->references('id')->on('typeProduct')
                ->onDelete('cascade');
            $table->timestamps();
        });

        Schema::create('personProduct', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('count');
            $table->integer('idPerson')->unsigned();
            $table->integer('idProduct')->unsigned();

            $table->foreign('idPerson')->references('id')->on('person');
            $table->foreign('idProduct')->references('id')->on('product');
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
        Schema::drop('typeProduct');
        Schema::drop('product');
    }
}
