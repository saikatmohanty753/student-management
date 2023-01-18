<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGrantedAffiliationCoursesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('granted_affiliation_courses', function (Blueprint $table) {
            $table->id();
            $table->string('app_id')->nullable();
            $table->string('stream_id')->nullable()->comment('course_for_id');
            $table->string('category_id')->nullable()->comment('course_type_id');
            $table->string('course_id')->nullable();
            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();
            $table->string('seat_no')->nullable();
            $table->timestamps();
        });

        Schema::table('college_affiliations', function (Blueprint $table) {
            $table->string('establishment_year')->nullable();
            $table->string('first_affiliation_year')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('granted_affiliation_courses');
    }
}
