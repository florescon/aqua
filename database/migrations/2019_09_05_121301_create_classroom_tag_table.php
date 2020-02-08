<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClassroomTagTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('classroom_tag', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('classroom_id')->nullable();
            $table->unsignedSmallInteger('tag_id')->nullable();
            $table->timestamps();
        });

        Schema::table('classroom_tag', function (Blueprint $table) {
            $table->foreign('classroom_id')->references('id')->on('classrooms')->onDelete('cascade');
        });

        Schema::table('classroom_tag', function (Blueprint $table) {
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
        Schema::dropIfExists('classroom_tag');
    }
}
