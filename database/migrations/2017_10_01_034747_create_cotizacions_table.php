<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCotizacionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cotizacions', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('valor_total')->unsigned();
            $table->integer('valor_neto')->unsigned();
            $table->integer('valor_iva')->unsigned();
            $table->integer('comision_vendedor')->nullable();
            $table->date('fecha');
            $table->text('descripcion');
            $table->boolean('despacho')->default(false);
            $table->boolean('diseno')->default(false);
            $table->boolean('montaje')->default(false);
            $table->integer('descuento')->nullable();
            $table->integer('nro')->nullable();
            // Claves Foraneas
            $table->integer('ventasuser_id')->unsigned();
            $table->foreign('ventasuser_id')->references('id')->on('ventasusers');
            $table->integer('cliente_id')->unsigned()->nullable();
            $table->foreign('cliente_id')->references('id')->on('clientes')->onDelete('set null');
            $table->integer('produccionuser_id')->unsigned()->nullable();
            $table->foreign('produccionuser_id')->references('id')->on('produccionusers');
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
