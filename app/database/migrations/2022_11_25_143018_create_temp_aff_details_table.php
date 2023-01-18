<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTempAffDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('temp_aff_details', function (Blueprint $table) {
            $table->id();
            $table->string('app_id')->nullable();
            $table->string('stream_id')->nullable()->comment('course_for_id');
            $table->string('category_id')->nullable()->comment('course_type_id');
            $table->string('course_id')->nullable();
            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();
            $table->string('seat_no')->nullable();
            $table->float('affiliation_fee',8,2)->nullable();
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
        Schema::dropIfExists('temp_aff_details');
    }
}
