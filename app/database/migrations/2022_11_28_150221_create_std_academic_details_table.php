<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStdAcademicDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('std_academic_details', function (Blueprint $table) {
            $table->id();
            $table->string('std_id')->nullable();
            $table->string('last_clg_name')->nullable();
            $table->enum('is_migration', ['0', '1'])->nullable();
            $table->string('migration_cert')->nullable();
            $table->text('year_of_passing')->nullable();
            $table->string('course_name')->nullable();
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
        Schema::dropIfExists('std_academic_details');
    }
}
