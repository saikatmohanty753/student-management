<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCoursesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('courses', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->string('course_type')->nullable();
            $table->enum('course_letter', ['A', 'B', 'C', 'D', 'E', 'F', 'G'])->default('A');
            $table->string('main_course_code')->nullable();
            $table->string('sub_course_code')->nullable();
            $table->string('total_sem')->nullable();
            $table->string('old_course_code')->nullable();
            $table->string('new_course_code')->nullable();
            $table->enum('status', ['1', '0'])->default('1');
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
        Schema::dropIfExists('courses');
    }
}
