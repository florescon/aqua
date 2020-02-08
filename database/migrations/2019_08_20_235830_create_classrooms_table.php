<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClassroomsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('classrooms', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->nullable();
            $table->unsignedSmallInteger('section_id')->nullable();
            $table->unsignedSmallInteger('classroom_type_id')->nullable();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->time('schedule')->nullable();
            $table->string('days')->nullable();
            $table->unsignedTinyInteger('status')->default(1);
            $table->timestamps();
        });

        Schema::table('classrooms', function (Blueprint $table) {
            $table->foreign('section_id')->references('id')->on('sections');
        });

        Schema::table('classrooms', function (Blueprint $table) {
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
        Schema::dropIfExists('classrooms');
    }
}
