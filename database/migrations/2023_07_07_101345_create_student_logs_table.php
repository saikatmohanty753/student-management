<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudentLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('student_logs', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id')->unsigned()->nullable();
            $table->integer('student_id')->unsigned()->nullable();
            $table->integer('course_id')->unsigned()->nullable();
            $table->integer('department_id')->unsigned()->nullable();
            $table->integer('updated_by')->unsigned()->nullable();
            $table->integer('clg_id')->unsigned()->nullable();
            $table->string('name', 200)->nullable();
            $table->string('email', 200)->nullable();
            $table->dateTime('updated_on')->nullable();
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
        Schema::dropIfExists('student_logs');
    }
}
