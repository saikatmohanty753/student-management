<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddCourseAffiliationFeeToTempAffDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('temp_aff_details', function (Blueprint $table) {
            $table->float('course_affiliation_fee')->default(0);
            $table->float('pledge_amount')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('temp_aff_details', function (Blueprint $table) {
            //
        });
    }
}
