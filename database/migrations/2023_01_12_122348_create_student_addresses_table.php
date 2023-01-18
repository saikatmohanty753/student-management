<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudentAddressesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('student_addresses', function (Blueprint $table) {
            $table->id();
            $table->string('student_id');
            $table->string('present_state')->nullable();
            $table->string('present_district_id')->nullable();
            $table->string('present_pin_code')->nullable();
            $table->text('present_address')->nullable();
            $table->string('permanent_state')->nullable();
            $table->string('permanent_district_id')->nullable();
            $table->string('permanent_pin_code')->nullable();
            $table->text('permanent_address')->nullable();
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
        Schema::dropIfExists('student_addresses');
    }
}
