<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class PageBase extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mpages', function($table){
            $table->increments('id');
            $table->integer('manga_id')->unsigned();
            $table->string('extension', 255);
            $table->integer('number');

            $table->index('number');
            $table->foreign('manga_id')->references('id')->on('mangas')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::DropIfExists('mpages');
    }
}
