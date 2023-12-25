<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFactorOffsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('factor_offs', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('factor_id')->unsigned();
            $table->foreign('factor_id')->references('id')->on('factors')->onDelete('cascade');
            $table->bigInteger('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->bigInteger('off_id')->unsigned()->default(0);
            $table->string('code',70)->default(0);
            $table->unsignedTinyInteger('type_off')->default(1); // 1 certain - 2 off - 3 tell
            $table->string('price',15)->default(0);
            $table->string('price_percent',5)->default(0);
            $table->string('price_factor',5)->default(0);
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
        Schema::dropIfExists('factor_offs');
    }
}
