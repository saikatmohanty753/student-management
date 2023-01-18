<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBuildingDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('building_details', function (Blueprint $table) {
            $table->id();
            $table->string('app_id')->nullable();
            $table->string('infra_id')->nullable();
            $table->enum('room_use', ['own', 'rented'])->default('own')->nullable();
            $table->string('length')->nullable();
            $table->string('width')->nullable();
            $table->string('area')->nullable();
            $table->string('capacity')->nullable();
            $table->string('room_type')->nullable();
            $table->string('roof_type')->nullable();
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
        Schema::dropIfExists('building_details');
    }
}
