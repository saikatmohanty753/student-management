<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAffiliationfeemastersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('affiliationfeemasters', function (Blueprint $table) {
          
            $table->id();
            $table->string('course_type')->nullable();
            $table->string('fee')->nullable();
            $table->string('type')->nullable();
            $table->string('fee_type')->nullable();
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
        Schema::dropIfExists('affiliationfeemasters');
    }
}
