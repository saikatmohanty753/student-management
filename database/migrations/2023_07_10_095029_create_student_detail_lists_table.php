<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudentDetailListsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('student_detail_lists', function (Blueprint $table) {
            $table->id();
            $table->integer('clg_id')->unsigned()->nullable();
            $table->string('table_name', 200)->nullable();
            $table->string('model', 200)->nullable();
            $table->tinyInteger('type')->nullable()->default(0)->comment('1=>User,2=>student application,3=>student address,4=>student details,5=>student education');
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
        Schema::dropIfExists('student_detail_lists');
    }
}
