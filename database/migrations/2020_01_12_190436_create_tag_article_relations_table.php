<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTagArticleRelationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tag_article_relations', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('tag_id')->unsigned();
            $table->foreign('tag_id')->references('id')->on('tags')->onDelete('cascade');
            $table->bigInteger('article_id')->unsigned();
            $table->foreign('article_id')->references('id')->on('articles')->onDelete('cascade');
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
        Schema::dropIfExists('tag_article_relations');
    }
}
