<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddNoticeIdToPgExaminationApplicationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('pg_examination_applications', function (Blueprint $table) {
            $table->bigInteger('notice_id')->after('stu_id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('pg_examination_applications', function (Blueprint $table) {
            $table->dropColumn('notice_id');
        });
    }
}
