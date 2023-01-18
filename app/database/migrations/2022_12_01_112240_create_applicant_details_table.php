<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateApplicantDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('applicant_details', function (Blueprint $table) {
            $table->id();
            $table->string('app_id')->nullable();
            $table->string('applicant_name')->nullable();
            $table->string('designation')->nullable();
            $table->string('aadhaar_no')->nullable();
            $table->string('email_id')->nullable();
            $table->string('mob_no')->nullable();
            $table->string('tel_no')->nullable();
            $table->text('undertaking_file')->nullable();
            $table->enum('is_agree', ['0', '1'])->default('1')->nullable();
            $table->enum('apply_status', ['1', '2', '3'])->default('1')->nullable();
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
        Schema::dropIfExists('applicant_details');
    }
}
