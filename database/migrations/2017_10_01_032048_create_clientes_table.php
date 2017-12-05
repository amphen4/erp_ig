<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClientesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clientes', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nombre');
            $table->string('email');
            $table->string('rut');
            $table->string('comuna')->nullable();
            $table->string('direccion');
            $table->string('region')->nullable();
            $table->string('fono1');
            $table->string('fono2')->nullable();
            $table->string('razon_social')->nullable(); // Nombre oficial y legal de una empresa
            $table->string('empresa')->nullable(); // Nombre oficial y legal de una empresa
            $table->string('giro');
            $table->integer('nro');
            $table->timestamps();
        });
        // Tabla relacion Muchos a Muchos
        Schema::create('ventasuser_cliente', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('ventasuser_id')->unsigned();
            $table->foreign('ventasuser_id')->references('id')->on('ventasusers')->onDelete('cascade');
            $table->integer('cliente_id')->unsigned();
            $table->foreign('cliente_id')->references('id')->on('clientes')->onDelete('cascade');
            $table->timestamps();
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
    }
}
