<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudentUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('student_users', function (Blueprint $table) {
            $table->id();
            $table->string('name','200')->nullable();
            $table->string('email')->unique()->nullable();
            $table->integer('role_id')->unsigned()->nullable();
            $table->string('clg_id','200')->nullable();
            $table->tinyInteger('is_active')->default(1);
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password', 200)->nullable();
            $table->string('remember_token','200')->nullable();
            $table->string('batch_year','200')->nullable();
            $table->bigInteger('mob_no')->nullable();
            $table->integer('clg_user_id')->unsigned()->nullable();
            $table->integer('student_id')->unsigned()->nullable();
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
        Schema::dropIfExists('student_users');
    }
}
