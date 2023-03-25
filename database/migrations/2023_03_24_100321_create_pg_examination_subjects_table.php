<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePgExaminationSubjectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pg_examination_subjects', function (Blueprint $table) {
            $table->id();
            $table->string('pg_id')->nullable();
            $table->string('subject_name')->nullable();
            $table->string('paper_name')->nullable();
            $table->string('paper_value')->nullable();
            $table->string('special_paper')->nullable();
            $table->string('special_paper_value')->nullable();
            $table->string('status')->nullable();
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
        Schema::dropIfExists('pg_examination_subjects');
    }
}
