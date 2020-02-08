<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCashOutDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cash_out_details', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('cash_out_id')->nullable();
            $table->timestamps();
        });

        Schema::table('cash_out_details', function (Blueprint $table) {
            $table->foreign('cash_out_id')->references('id')->on('cash_outs')->onDelete('cascade');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cash_out_details');
    }
}
