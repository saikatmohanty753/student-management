<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCollegeManagementDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('college_management_details', function (Blueprint $table) {
            $table->id();
            $table->string('clg_id')->nullable();
            $table->string('name')->nullable();
            $table->string('aadhaar_no')->nullable();
            $table->string('contact_no')->nullable();
            $table->string('email')->nullable();
            $table->enum('management_role', ['president', 'secretary', 'principal',''])->default('')->nullable();
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
        Schema::dropIfExists('college_management_details');
    }
}
