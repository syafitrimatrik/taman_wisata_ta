<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Comment extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('comment', function(Blueprint $table) {
            $table->increments('id');
            $table->integer('users_id')->nullable();
            $table->text('comment')->nullable();
            $table->string('like')->nullable();
            $table->integer('comment_id')->nullable();
            $table->integer('taman_wisata_id')->nullable();
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
        Schema::drop('comment');
    }
}
