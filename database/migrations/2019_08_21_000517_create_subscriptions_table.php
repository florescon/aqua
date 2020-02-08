<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSubscriptionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('subscriptions', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedBigInteger('user_id')->nullable();
            $table->string('price')->nullable();
            $table->longText('comment')->nullable();
            $table->unsignedMediumInteger('audi_id')->nullable();
            $table->date('start_date')->nullable();
            $table->date('finish_date')->nullable();
            $table->unsignedSmallInteger('payment_method_id')->nullable();
            $table->longText('ticket_text')->nullable();
            $table->unsignedInteger('box')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::table('subscriptions', function (Blueprint $table) {
            $table->foreign('user_id')->references('id')->on('users');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('subscriptions');
    }
}
