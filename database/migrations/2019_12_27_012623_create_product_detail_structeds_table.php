<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductDetailStructedsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_detail_structeds', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('product_detail_id')->unsigned();
            $table->foreign('product_detail_id')->references('id')->on('product_details')->onDelete('cascade');
            $table->string('title');
            $table->text('text')->nullable();
            $table->unsignedTinyInteger('type')->default(1); // 1 text - 2 true false
            $table->unsignedTinyInteger('status')->default(1);
            $table->unsignedTinyInteger('sort')->default(1);
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
        Schema::dropIfExists('product_detail_structeds');
    }
}
