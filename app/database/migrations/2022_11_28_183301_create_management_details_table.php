<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateManagementDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('management_details', function (Blueprint $table) {
            $table->id();
            $table->string('app_id')->nullable();
            $table->string('social_welfare')->nullable();
            $table->string('welfare_name')->nullable();
            $table->string('welfare_no')->nullable();
            $table->string('welfare_year')->nullable();
            $table->text('welfare_cert')->nullable();
            $table->string('president_name')->nullable();
            $table->string('president_aadhaar')->nullable();
            $table->string('president_contact_no')->nullable();
            $table->string('president_email')->nullable();
            $table->string('secretary_name')->nullable();
            $table->string('secretary_aadhaar')->nullable();
            $table->string('secretary_contact_no')->nullable();
            $table->string('secretary_email')->nullable();
            $table->string('principal_name')->nullable();
            $table->string('principal_aadhaar')->nullable();
            $table->string('principal_contact_no')->nullable();
            $table->string('principal_email')->nullable();
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
        Schema::dropIfExists('management_details');
    }
}
