<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFactorProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('factor_products', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('factor_id')->unsigned();
            $table->foreign('factor_id')->references('id')->on('factors')->onDelete('cascade');
            $table->bigInteger('product_id')->unsigned();
            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
            $table->unsignedTinyInteger('price_type')->default(1); // 1 certain - 2 off - 3 tell
            $table->string('price',15)->default(0);
            $table->string('price_percent',5)->default(0);
            $table->unsignedTinyInteger('count')->default(1);
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
        Schema::dropIfExists('factor_products');
    }
}
