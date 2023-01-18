<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudentDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('student_details', function (Blueprint $table) {
            $table->id();
            $table->string('clg_id')->nullable();
            $table->integer('department_id')->nullable();
            $table->integer('course_id')->nullable();
            $table->string('name')->nullable();
            $table->string('email')->nullable();
            $table->string('mobile')->nullable();
            $table->string('mother_name')->nullable();
            $table->string('father_name')->nullable();
            $table->string('gender')->nullable();
            $table->date('dob')->nullable();
            $table->string('cast')->nullable();
            $table->enum('specially_abled', ['0', '1'])->default('0');
            $table->string('aadhaar_no')->nullable();
            $table->string('regd_no')->nullable();
            $table->enum('regd_no_issued', ['0', '1'])->default('0');
            $table->enum('app_status', ['0', '1'])->default('0');
            $table->integer('status')->nullable();
            $table->text('remarks')->nullable();
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
        Schema::dropIfExists('student_details');
    }
}
