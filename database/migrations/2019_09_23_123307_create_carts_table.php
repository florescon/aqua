<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCartsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('carts', function (Blueprint $table) {
            $table->mediumIncrements('id');
            $table->unsignedSmallInteger('product_id');
            $table->integer('quantity')->nullable();
            $table->double('price')->nullable();
            $table->unsignedMediumInteger('audi_id')->nullable();
            $table->timestamps();
        });

        Schema::table('carts', function (Blueprint $table) {
            $table->foreign('product_id')->references('id')->on('products');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('carts');
    }
}
