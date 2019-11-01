<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title');   // VARCHAR equivalent with a length
            $table->boolean('published')->default(true);   // BOOLEAN equivalent to the table
            $table->bigInteger('votes')->unsigned()->default(0); 
            $table->bigInteger('category_id')->unsigned(); 
            $table->longText('content');  // LONGTEXT equivalent to the table
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
        Schema::dropIfExists('posts');
    }
}
