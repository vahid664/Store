<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFactorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('factors', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->string('price')->nullable();
            $table->string('price_send')->nullable();
            $table->string('trans_id')->nullable();
            $table->string('refrence_id')->nullable();
            $table->string('ntracking')->nullable();
            $table->string('description')->nullable();
            $table->unsignedTinyInteger('status')->default(0);
            $table->unsignedTinyInteger('delivery')->default(0);
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
        Schema::dropIfExists('factors');
    }
}
