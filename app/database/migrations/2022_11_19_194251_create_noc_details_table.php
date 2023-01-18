<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNocDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('noc_details', function (Blueprint $table) {
            $table->id();
            $table->string('college_name',255)->nullable();
            $table->string('noc_letter_no',50)->nullable();
            $table->date('noc_date')->nullable();
            $table->string('noc_path',255)->nullable();
            $table->integer('status')->default(1);
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
        Schema::dropIfExists('noc_details');
    }
}
