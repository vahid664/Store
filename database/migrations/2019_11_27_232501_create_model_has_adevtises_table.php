<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateModelHasAdevtisesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('model_has_adevtises', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('adver_id')->unsigned();
            $table->foreign('adver_id')->references('id')->on('advertises')->onDelete('cascade');
            $table->unsignedBigInteger('model_id');
            $table->unsignedTinyInteger('model_type')->default(1); // 1 category - 2 brand - 3 product - 4 tag
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
        Schema::dropIfExists('model_has_adevtises');
    }
}
