<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAcademicCourseStructuresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('academic_course_structures', function (Blueprint $table) {
            $table->id();
            $table->string('year')->nullable();
            $table->string('session_year')->nullable();
            $table->integer('dep_id')->nullable();
            $table->integer('course_id')->nullable();
            $table->integer('semester')->nullable();
            $table->string('paper_code')->nullable();
            $table->string('subject')->nullable();
            $table->integer('paper_type_id')->nullable();
            $table->integer('paper_sub_type_id')->nullable();
            $table->float('mid_sem_mark')->nullable();
            $table->float('end_sem_mark')->nullable();
            $table->float('total_marks')->nullable();
            $table->float('pass_mark')->nullable();
            $table->integer('credit')->nullable();
            $table->integer('status')->default(1)->nullable();
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
        Schema::dropIfExists('academic_course_structures');
    }
}
