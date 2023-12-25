<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdvertisesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('advertises', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->string('title',100)->nullable();
            $table->string('title_en',100)->nullable();
            $table->string('description')->nullable();
            $table->string('pic',100)->nullable();
            $table->string('pic_alt',100)->nullable();
            $table->string('url')->nullable();
            $table->unsignedTinyInteger('where_page')->default(1); // 1 home - 2 category - 3 brand - 4 product - 5 tag
            $table->unsignedTinyInteger('location')->default(1); //1 slider - 2 top page - 3 right side - 4 product between - 5 end page
            $table->unsignedTinyInteger('status')->default(0); // 0 hide - 1 show
            $table->unsignedInteger('sort')->default(1);
            $table->unsignedTinyInteger('platform_status')->default(0); // 0 show all - 1 pc - 2 mobile - 3 tablet
            $table->unsignedTinyInteger('type_open')->default(1); // 1 new page - 2 this page
            $table->string('date_start',30)->nullable();
            $table->string('date_end',30)->nullable();
            $table->unsignedTinyInteger('ads_type')->default(1); // 1 indoor - 2 indoor ads - 3 outdoor ads
            $table->unsignedTinyInteger('banner_type')->default(1); //1 image - 2 image & text - 3 text
            $table->string('button_title')->nullable(); // buy - show , ...
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
        Schema::dropIfExists('advertises');
    }
}
