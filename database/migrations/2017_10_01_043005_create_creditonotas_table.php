<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCreditonotasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('creditonotas', function (Blueprint $table) {
            $table->increments('id');
            $table->date('fecha');
            $table->text('texto');
            $table->string('filename')->unique();
            // Claves Foraneas
            $table->integer('ot_id')->unsigned()->unique()->nullable();
            $table->foreign('ot_id')->references('id')->on('ots')->onDelete('set null');
            $table->integer('factura_id')->unsigned()->unique()->nullable();
            $table->foreign('factura_id')->references('id')->on('facturas')->onDelete('set null');
            $table->integer('ventasuser_id')->unsigned();
            $table->foreign('ventasuser_id')->references('id')->on('ventasusers');
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
