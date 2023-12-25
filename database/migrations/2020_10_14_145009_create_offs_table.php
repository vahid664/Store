<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOffsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('offs', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->string('title')->unique();
            $table->string('code',70)->unique();
            $table->string('count',30)->default(0);
            $table->string('count_use',30)->default(0);
            $table->unsignedTinyInteger('type_off')->default(1); // 1 cach - 2 percent - 3 percent-factor
            $table->string('price',30)->default(0);
            $table->string('price_percent',30)->default(0);
            $table->string('price_factor',30)->default(0);
            $table->string('date_start',30)->nullable();
            $table->string('date_end',30)->nullable();
            $table->unsignedBigInteger('customer_id')->default(0);
            $table->unsignedBigInteger('product_id')->default(0);
            $table->unsignedTinyInteger('status')->default(1);
            $table->unsignedBigInteger('sort')->default(1);
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
        Schema::dropIfExists('offs');
    }
}
