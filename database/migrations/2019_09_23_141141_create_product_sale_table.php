<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductSaleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_sale', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedMediumInteger('sale_id')->nullable();
            $table->unsignedSmallInteger('product_id')->nullable();
            $table->integer('quantity')->nullable();
            $table->double('price')->nullable();
            $table->timestamps();
        });

        Schema::table('product_sale', function (Blueprint $table) {
            $table->foreign('sale_id')->references('id')->on('sales')->onDelete('cascade');
        });

        Schema::table('product_sale', function (Blueprint $table) {
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
        Schema::dropIfExists('product_sale');
    }
}
