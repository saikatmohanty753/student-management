<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOtherInfrastructuresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('other_infrastructures', function (Blueprint $table) {
            $table->id();
            $table->string('app_id')->nullable();
            $table->string('infra_id')->nullable();
            $table->enum('boundary_wall', ['0', '1'])->default('0')->nullable();
            $table->string('boundary_req_length')->nullable();
            $table->string('boundary_act_length')->nullable();
            $table->enum('playground', ['0', '1'])->default('0')->nullable();
            $table->string('playground_length')->nullable();
            $table->string('playground_width')->nullable();
            $table->enum('game_equipment', ['0', '1'])->default('0')->nullable();
            $table->enum('guest_hall', ['0', '1'])->default('0')->nullable();
            $table->enum('conference_hall', ['0', '1'])->default('0')->nullable();
            $table->enum('auditorium', ['0', '1'])->default('0')->nullable();
            $table->enum('staff_residence', ['0', '1'])->default('0')->nullable();
            $table->string('book')->nullable();
            $table->string('reading_room')->nullable();
            $table->string('magazine')->nullable();
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
        Schema::dropIfExists('other_infrastructures');
    }
}
