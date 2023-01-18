<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAffiliationCourseFeesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Schema::create('affiliation_course_fees', function (Blueprint $table) {
        //     $table->id();
        //     $table->timestamps();
        // });
        Schema::table('college_affiliations', function (Blueprint $table) {
            $table->string('affiliation_payment_status')->nullable();
            $table->string('affiliation_payment_id')->nullable();
            $table->text('inspection_verify_remarks')->nullable();
            $table->text('mom_verify_remarks')->nullable();
            $table->text('resolution_verify_remarks')->nullable();
            $table->text('academic_payment_remarks')->nullable();
            $table->text('registrar_payment_remarks')->nullable();
            $table->string('apply_by')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('affiliation_course_fees');
    }
}
