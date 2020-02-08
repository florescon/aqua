<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePaymentTagTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payment_tag', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('payment_id')->nullable();
            $table->unsignedSmallInteger('tag_id')->nullable();
            $table->timestamps();
        });

        Schema::table('payment_tag', function (Blueprint $table) {
            $table->foreign('payment_id')->references('id')->on('payments')->onDelete('cascade');
        });

        Schema::table('payment_tag', function (Blueprint $table) {
            $table->foreign('tag_id')->references('id')->on('tags');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('payment_tag');
    }
}
