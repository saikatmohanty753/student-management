<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAffiliationRegistrationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('affiliation_registrations', function (Blueprint $table) {
            $table->id();
            $table->string('application_id')->nullable();
            $table->integer('user_id')->nullable();
            $table->string('college_name')->nullable();
            $table->string('district_id')->nullable();
            $table->string('block_id')->nullable();
            $table->string('police_station_id')->nullable();
            $table->string('pin_code')->nullable();
            $table->text('location')->nullable();
            $table->string('applicant_name')->nullable();
            $table->text('applicant_designation')->nullable();
            $table->text('applicant_aadhaar_no')->nullable();
            $table->text('applicant_email')->nullable();
            $table->text('applicant_mobile_no')->nullable();
            $table->text('applicant_tel_no')->nullable();
            $table->text('noc_no')->nullable();
            $table->text('noc_date')->nullable();
            $table->text('noc_file')->nullable();
            $table->enum('payment_status', ['1', '0'])->default('0');
            $table->string('application_status')->nullable();
            $table->string('payment_id')->nullable();
            $table->string('registration_date')->nullable();
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
        Schema::dropIfExists('affiliation_registrations');
    }
}
