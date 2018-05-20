<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AuthorBase extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('authors', function($table){
            $table->increments('id');
            $table->string('firstname', 255)->nullable();
            $table->string('name', 255)->nullable();
            $table->string('alias', 255)->nullable();
            $table->boolean('deceased')->nullable();

            $table->index('name');
            $table->index('alias');
        });

        Schema::table('mangas', function($table){
            $table->integer('author_id')->unsigned()->nullable()->after('id');
            $table->foreign('author_id')->references('id')->on('authors')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('mangas', function($table){
            $table->dropForeign(['author_id']);
            $table->dropColumn('author_id');
        });
        Schema::DropIfExists('authors');
    }
}
