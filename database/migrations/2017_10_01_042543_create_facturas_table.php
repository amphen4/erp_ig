<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFacturasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('facturas', function (Blueprint $table) {
            $table->increments('id');
            $table->string('filename')->nullable();
            $table->string('rut');
            $table->string('cliente');
            $table->date('fecha');
            $table->integer('total')->unsigned();
            $table->integer('iva')->unsigned();
            $table->integer('neto')->unsigned();
            // Claves Foraneas
            $table->integer('ot_id')->unsigned();
            $table->foreign('ot_id')->references('id')->on('ots')->onDelete('cascade');
            $table->integer('facturacionuser_id')->unsigned()->nullable();
            $table->foreign('facturacionuser_id')->references('id')->on('facturacionusers')->onDelete('set null');
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
