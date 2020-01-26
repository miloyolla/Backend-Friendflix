<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSeriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      //Criar serie com seus atributos
        Schema::create('series', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->String('name');
            $table->String('genre')->nullable();
            $table->longText('synopsis');
            $table->integer('likes')->unsigned();
            $table->integer('seasons');
            $table->float('rating')->nullable();
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
        Schema::dropIfExists('series');
    }
}
