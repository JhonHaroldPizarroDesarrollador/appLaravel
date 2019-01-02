<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDataScrapingTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('datascrapings', function (Blueprint $table) {
            $table->increments('id');
            $table->string('pagina', 999);
            $table->string('selector', 999);
            $table->string('titulo', 999);
            $table->string('imagen', 999);
            $table->string('url', 999);
            $table->string('precio', 999);
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
        Schema::dropIfExists('datascrapings');
    }
}
