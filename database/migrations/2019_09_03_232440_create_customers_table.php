<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCustomersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customers', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('user_id');
            $table->unsignedSmallInteger('blood_id')->nullable();
            $table->string('identifier')->nullable();
            $table->string('phone')->nullable();
            $table->date('age')->nullable();
            $table->unsignedInteger('school_id')->nullable();
            $table->string('grade')->nullable();
            $table->string('address')->nullable();
            $table->string('ins')->nullable();
            $table->timestamps();
        });

        Schema::table('customers', function (Blueprint $table) {
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });

        Schema::table('customers', function (Blueprint $table) {
            $table->foreign('blood_id')->references('id')->on('bloods');
        });

        Schema::table('customers', function (Blueprint $table) {
            $table->foreign('school_id')->references('id')->on('schools');
        });


    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('customers');
    }
}
