<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddToTableAdvertises extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('advertises', function (Blueprint $table) {
            $table->unsignedTinyInteger('size')->default(1); // 1 full size - 2 half size - 3 fourth
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('advertises', function (Blueprint $table) {
            $table->dropColumn(['size']);
        });
    }
}
