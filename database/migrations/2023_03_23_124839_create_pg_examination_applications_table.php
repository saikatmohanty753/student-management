<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePgExaminationApplicationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pg_examination_applications', function (Blueprint $table) {
            $table->id();
            $table->integer('stu_id');
            $table->integer('payment_status')->default(0);
            $table->integer('form_status')->default(0);
            $table->integer('app_status')->default(0);
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
        Schema::dropIfExists('pg_examination_applications');
    }
}
