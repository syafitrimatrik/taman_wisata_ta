<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class TamanWisata extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('taman_wisata', function(Blueprint $table) {
            $table->increments('id');
            $table->integer('users_id')->nullable();
            $table->double('price')->nullable();
            $table->string('title')->nullable();
            $table->string('thumbnail')->nullable();
            $table->string('simple_location')->nullable();
            $table->string('excerpt')->nullable();
            $table->double('latitude')->nullable();
            $table->double('longitude')->nullable();
            $table->double('jarak')->nullable();
            $table->double('rating')->nullable();
            $table->text('description')->nullable();
            $table->text('maps')->nullable();
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
        Schema::drop('taman_wisata');
    }
}
