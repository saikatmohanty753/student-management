<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAcademicActivitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('academic_activities', function (Blueprint $table) {
            $table->id();
            $table->string('app_id')->nullable();
            $table->string('is_satisfactory')->nullable();
            $table->string('appeared_student')->nullable();
            $table->string('first_class')->nullable();
            $table->string('second_class')->nullable();
            $table->string('third_class')->nullable();
            $table->string('academic_status')->nullable();
            $table->text('academic_remarks')->nullable();
            $table->text('insp_remarks')->nullable();
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
        Schema::dropIfExists('academic_activities');
    }
}
