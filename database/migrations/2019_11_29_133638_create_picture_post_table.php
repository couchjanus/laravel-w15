<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePicturePostTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('picture_post', function (Blueprint $table) {
            $table->bigInteger('post_id')->unsigned();
            $table->bigInteger('picture_id')->unsigned();
            $table->foreign('post_id')->references('id')->on('posts');
            $table->foreign('picture_id')->references('id')->on('pictures');   
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('picture_post');
    }
}
