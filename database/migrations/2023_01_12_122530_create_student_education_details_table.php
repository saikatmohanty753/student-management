<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudentEducationDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('student_education_details', function (Blueprint $table) {
            $table->id();
            $table->string('student_id');
            $table->string('clg_name')->nullable();
            $table->string('year_of_passing')->nullable();
            $table->string('course_name')->nullable();
            $table->enum('is_migration_cert', ['0', '1'])->default('0');
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
        Schema::dropIfExists('student_education_details');
    }
}
