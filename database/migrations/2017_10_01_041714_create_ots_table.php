<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOtsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ots', function (Blueprint $table) {
            $table->increments('id');
            $table->date('fecha');
            $table->date('fecha_entrega')->nullable();
            $table->string('comentario')->nullable();
            $table->string('medio_pago')->nullable();
            $table->integer('nro');
            // Claves Foraneas
            $table->integer('cotizacion_id')->unsigned()->unique()->nullable();
            $table->foreign('cotizacion_id')->references('id')->on('cotizacions')->onDelete('restrict');
            $table->integer('otestado_id')->unsigned();
            $table->foreign('otestado_id')->references('id')->on('otestados')->onUpdate('cascade')->onDelete('restrict');
            $table->integer('adminuser_id')->unsigned()->nullable();
            $table->foreign('adminuser_id')->references('id')->on('adminusers');
            $table->timestamps();
        });
        Schema::enableForeignKeyConstraints();
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
