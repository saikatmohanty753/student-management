<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdmissionSeatsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('admission_seats', function (Blueprint $table) {
            $table->id();
            $table->string('admission_year')->nullable();
            $table->integer('clg_id')->nullable();
            $table->integer('department_id')->nullable();
            $table->integer('course_id')->nullable();
            $table->integer('available_seat')->nullable();
            $table->integer('consumption_seat')->nullable();
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
        Schema::dropIfExists('admission_seats');
    }
}
