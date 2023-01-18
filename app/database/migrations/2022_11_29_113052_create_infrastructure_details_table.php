<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInfrastructureDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('infrastructure_details', function (Blueprint $table) {
            $table->id();
            $table->string('app_id')->nullable();
            $table->string('type')->nullable();
            $table->string('district_id')->nullable();
            $table->string('block_id')->nullable();
            $table->string('mouza')->nullable();
            $table->string('khata_no')->nullable();
            $table->string('pattdar')->nullable();
            $table->string('ploat_no')->nullable();
            $table->string('area')->nullable();
            $table->string('kisam')->nullable();
            $table->string('ror_copy')->nullable();
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
        Schema::dropIfExists('infrastructure_details');
    }
}
