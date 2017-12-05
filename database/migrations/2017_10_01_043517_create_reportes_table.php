<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReportesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reportes', function (Blueprint $table) {
            $table->increments('id');
            $table->date('fecha');
            $table->text('comentario')->nullable();
            $table->string('filename');
            $table->timestamps();
            // Claves Foraneas
            $table->integer('ot_id')->unsigned();
            $table->foreign('ot_id')->references('id')->on('ots')->onDelete('cascade');
            $table->integer('otestado_id')->unsigned();
            $table->foreign('otestado_id')->references('id')->on('otestados')->onDelete('restrict');
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
