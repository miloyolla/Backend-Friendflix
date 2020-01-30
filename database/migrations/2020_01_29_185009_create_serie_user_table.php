<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSerieUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('serie_user', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('user_id')->nullable();
            $table->unsignedBigInteger('serie_id')->nullable();
            $table->timestamps();
        });

        //Foreign key
        Schema::table('serie_user', function (Blueprint $table) {
          $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });

        Schema::table('serie_user', function (Blueprint $table) {
          $table->foreign('serie_id')->references('id')->on('series')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('serie_user');
    }
}
