<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCommentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('comments', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id')->unsigned()->default(0);
            $table->bigInteger('parent')->unsigned()->default(0);
            $table->string('title')->nullable();
            $table->string('name')->nullable();
            $table->string('email')->nullable();
            $table->text('text')->nullable();
            $table->unsignedTinyInteger('accept')->default(0);
            $table->unsignedInteger('vote')->default(0);
            $table->unsignedTinyInteger('status')->default(0);
            $table->bigInteger('admin_id')->unsigned()->default(0);
            $table->integer('commentable_id');
            $table->string("commentable_type");
            $table->unsignedBigInteger('sort')->default(1);
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
        Schema::dropIfExists('comments');
    }
}
