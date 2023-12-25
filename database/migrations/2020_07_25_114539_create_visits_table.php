<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVisitsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('visits', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('user_id')->default(0);
            $table->string('ip',60)->nullable();
            $table->string('system',30)->nullable();
            $table->string('system_vertion',30)->nullable();
            $table->string('browser',30)->nullable();
            $table->string('browser_vertion',30)->nullable();
            $table->string('url')->nullable(); //url decode with php before save in mysql
            $table->unsignedBigInteger('product_id')->default(0);
            $table->unsignedBigInteger('article_id')->default(0);
            $table->string('time_start',15)->nullable();
            $table->string('time_end',15)->nullable();
            $table->string('session_id')->default(0);
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
        Schema::dropIfExists('visits');
    }
}
