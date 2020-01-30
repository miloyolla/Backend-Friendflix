<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCommentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('comments', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->longText('text');
            $table->integer('likes')->unsigned();
            $table->integer('share')->unsigned();
            $table->unsignedBigInteger('user_id')->nullable();
            //$table->unsignedBigInteger('serie_id')->nullable();
            $table->timestamps();
        });
        //Foreign key
        Schema::table('comments', function (Blueprint $table) {
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });

        // Schema::table('comments', function (Blueprint $table) {
        //     $table->foreign('serie_id')->references('id')->on('series')->onDelete('cascade');
        // });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('comments');
    }
}
