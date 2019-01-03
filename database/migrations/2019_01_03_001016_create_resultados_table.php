<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateResultadosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('resultados', function (Blueprint $table) {
            $table->increments('id');
            //$table->foreign('id')->references('pagina')->on('datascrapings');
            $table->string('nombre', 999);
            $table->string('precio', 999);
            $table->string('imagen', 999);
            $table->string('url', 999);
            $table->integer('datascraping_id')->unsigned();
            $table->foreign('datascraping_id')->references('id')->on('datascrapings');
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
        Schema::dropIfExists('resultados');
    }
}
