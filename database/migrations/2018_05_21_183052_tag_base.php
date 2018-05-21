<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TagBase extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tags', function($table){
            $table->increments('id');
            $table->string('name');
            $table->boolean('type')->nullable();

            $table->index('name');
        });

        Schema::create('manga_tag', function($table){
            $table->integer('manga_id')->unsigned();
            $table->integer('tag_id')->unsigned();

            $table->foreign('manga_id')->references('id')->on('mangas')->onDelete('cascade');
            $table->foreign('tag_id')->references('id')->on('tags')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::DropIfExists('manga_tag');
        Schema::DropIfExists('tags');
    }
}
