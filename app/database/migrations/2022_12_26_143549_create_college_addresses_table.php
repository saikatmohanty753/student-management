<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCollegeAddressesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('college_addresses', function (Blueprint $table) {
            $table->id();
            $table->string('clg_id')->nullable();
            $table->string('rev_district_id')->nullable();
            $table->string('rev_block_id')->nullable();
            $table->string('rev_ps_id')->nullable();
            $table->string('rev_pin_code')->nullable();
            $table->string('rev_tel_no')->nullable();
            $table->string('rev_village_town')->nullable();
            $table->string('pos_district_id')->nullable();
            $table->string('pos_block_id')->nullable();
            $table->string('pos_ps_id')->nullable();
            $table->string('pos_pin_code')->nullable();
            $table->string('pos_tel_no')->nullable();
            $table->string('pos_village_town')->nullable();
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
        Schema::dropIfExists('college_addresses');
    }
}
