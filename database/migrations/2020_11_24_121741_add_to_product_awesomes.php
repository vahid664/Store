<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddToProductAwesomes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('product_awesomes', function (Blueprint $table) {
            $table->string('hour_start',12)->default(1);
            $table->string('hour_end',12)->default(23);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('product_awesomes', function (Blueprint $table) {
            $table->dropColumn(['hour_start','hour_end']);
        });
    }
}
