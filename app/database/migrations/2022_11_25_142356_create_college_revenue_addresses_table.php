<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCollegeRevenueAddressesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('college_revenue_addresses', function (Blueprint $table) {
            $table->id();
            $table->string('app_id')->nullable();
            $table->enum('is_urban_area', ['1', '0'])->default('1');
            $table->string('district')->nullable();
            $table->string('block')->nullable();
            $table->string('police_station')->nullable();
            $table->string('pin_code')->nullable();
            $table->string('phone_no')->nullable();
            $table->string('village_town')->nullable();
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
        Schema::dropIfExists('college_revenue_addresses');
    }
}
