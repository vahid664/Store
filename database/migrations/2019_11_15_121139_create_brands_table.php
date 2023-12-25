<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBrandsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('brands', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->string('title',100);
            $table->string('title_en',70)->nullable();
            $table->mediumText('text')->nullable();
            $table->string('pic',100)->nullable();
            $table->string('pic_alt',100)->nullable();
            $table->string('color',20)->nullable();
            $table->string('keywords',100)->nullable();
            $table->string('description',255)->nullable();
            $table->unsignedTinyInteger('sort')->default(1);
            $table->unsignedTinyInteger('status')->default(1);
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
        Schema::dropIfExists('brands');
    }
}
