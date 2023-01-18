<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGovtNocForAffiliationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('govt_noc_for_affiliations', function (Blueprint $table) {
            $table->id();
            $table->string('app_id')->nullable();
            $table->string('noc_letter_no')->nullable();
            $table->date('noc_letter_date')->nullable();
            $table->text('noc_file')->nullable();
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
        Schema::dropIfExists('govt_noc_for_affiliations');
    }
}
