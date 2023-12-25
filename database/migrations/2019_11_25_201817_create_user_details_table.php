<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_details', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->string('avatar',100)->nullable();
            $table->unsignedTinyInteger('avatar_flag')->default(0);
            $table->unsignedTinyInteger('news_receive')->default(1);
            $table->string('national_code',10)->nullable();
            $table->unsignedTinyInteger('sex')->default(0); // 0 no detect - 1 man - 2 women
            $table->string('bill',30)->nullable();
            $table->string('bill_cart',30)->nullable();
            $table->string('birthday_year',4)->nullable();
            $table->string('birthday_month',2)->nullable();
            $table->string('birthday_day',2)->nullable();
            $table->unsignedTinyInteger('status')->default(0);
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
        Schema::dropIfExists('user_details');
    }
}
