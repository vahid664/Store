<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->bigInteger('brand_id')->unsigned();
            $table->foreign('brand_id')->references('id')->on('brands')->onDelete('cascade');
            $table->string('title',100);
            $table->string('title_en',100)->nullable();
            $table->string('keywords',100)->nullable();
            $table->string('description')->nullable();
            $table->text('short_text')->nullable();
            $table->mediumText('long_text')->nullable();
            $table->unsignedTinyInteger('price_send')->default(1); // 1 have - 0 not have
            $table->unsignedTinyInteger('origin')->default(1); // 1 origin - 0 not origin
            $table->unsignedTinyInteger('deliver')->default(1); // 1 fast - 2 timely
            $table->unsignedTinyInteger('warranty')->default(1); // 1 have - 0 not have
            $table->unsignedTinyInteger('price_type')->default(1); // 1 certain - 2 off - 3 tell
            $table->string('price',15)->default(0);
            $table->string('price_percent')->default(0);
            $table->string('price_self_buy')->default(0);
            $table->unsignedSmallInteger('entity')->default(0);
            $table->unsignedBigInteger('before')->default(0);
            $table->unsignedBigInteger('after')->default(0);
            $table->unsignedInteger('visit')->default(0);
            $table->unsignedTinyInteger('index')->default(0); // 0 no index - 1 slider - 2 home page, ...
            $table->unsignedTinyInteger('status')->default(0); // 0 hide - 1 available - 2 unavailable
            $table->unsignedTinyInteger('flag_pic_thumbnail')->default(0); // 0 no - 1 yes
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
        Schema::dropIfExists('products');
    }
}
