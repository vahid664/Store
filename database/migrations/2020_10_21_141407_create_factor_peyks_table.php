<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFactorPeyksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('factor_peyks', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('factor_id')->unsigned();
            $table->foreign('factor_id')->references('id')->on('factors')->onDelete('cascade');
            $table->unsignedBigInteger('peyk_id')->default(0);
            $table->string('date',30);
            $table->string('time',30);
            $table->string('price',30)->default(0);
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
        Schema::dropIfExists('factor_peyks');
    }
}
