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
            $table->string('regd_no')->nullable();
            $table->string('course_id')->nullable();
            $table->text('passport_photo')->nullable();
            $table->string('aadhaar_no')->nullable();
            $table->text('aadhaar_card')->nullable();
            $table->string('first_name')->nullable();
            $table->string('last_name')->nullable();
            $table->string('mother_name')->nullable();
            $table->string('father_name')->nullable();
            $table->string('gender')->nullable();
            $table->date('dob')->nullable();
            $table->text('hsc_cert')->nullable();
            $table->enum('category', ['ST', 'SC', 'OBC', 'GEN'])->nullable();
            $table->text('cast_cert')->nullable();
            $table->enum('specially_abled', ['0', '1'])->nullable();
            $table->text('specially_abled_cert')->nullable();
            $table->bigInteger('mob_no')->nullable();
            $table->string('email')->nullable();
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
