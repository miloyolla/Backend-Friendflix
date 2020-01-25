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
      //criando serie com seus atributos
        Schema::create('series', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->String('name');
            $table->String('genre')->nullable();
            $table->longText('synopsis');
            $table->integer('likes')->unsigned();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->integer('number_of_seasons');
            $table->float('rating');
            $table->timestamps();
            });

            //Foreign key
            Schema::table('series', function (Blueprint $table) {
              $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
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
