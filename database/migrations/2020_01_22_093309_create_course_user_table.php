<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCourseUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('course_user', function (Blueprint $table) {

            // Primary Key
            $table->bigIncrements('id');

            //Fields
            $table->unsignedBigInteger('course_id')->nullable(false);
            $table->unsignedBigInteger('user_id')->nullable(false);

            // Constraints
            $table->foreign('course_id')->references('id')->on('course');
            $table->foreign('user_id')->references('id')->on('users');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('course_user');
    }
}
