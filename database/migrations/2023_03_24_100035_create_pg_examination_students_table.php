<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePgExaminationStudentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pg_examination_students', function (Blueprint $table) {
            $table->id();
            $table->string('std_id')->nullable();
            $table->string('college_name')->nullable();
            $table->string('batch_year')->nullable();
            $table->string('draft_status')->nullable();
            $table->string('appearing_exam')->nullable();
            $table->string('previous_exam_appearance')->nullable();
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
        Schema::dropIfExists('pg_examination_students');
    }
}
