<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddApplicationNoToStudentApplicationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('student_applications', function (Blueprint $table) {
            $table->string('applicaton_no', 250)->nullable();
            $table->string('app_count_no', 250)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('student_applications', function (Blueprint $table) {
            $table->dropColumn('applicaton_no');
            $table->dropColumn('app_count_no');
        });
    }
}
