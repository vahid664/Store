<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateArticlesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('articles', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->bigInteger('category_id')->unsigned();
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
            $table->string('title',100);
            $table->string('title_en',100)->nullable();
            $table->string('keywords',100)->nullable();
            $table->string('description')->nullable();
            $table->text('short_text')->nullable();
            $table->mediumText('long_text')->nullable();
            $table->string('period',100)->nullable();
            $table->unsignedBigInteger('before')->default(0);
            $table->unsignedBigInteger('after')->default(0);
            $table->unsignedInteger('visit')->default(0);
            $table->unsignedTinyInteger('index')->default(0); // 0 no index - 2 home page article, ...
            $table->unsignedTinyInteger('status')->default(0); // 0 hide - 1 available
            $table->unsignedInteger('sort')->default(1);
            $table->softDeletes();
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
        Schema::dropIfExists('articles');
    }
}
