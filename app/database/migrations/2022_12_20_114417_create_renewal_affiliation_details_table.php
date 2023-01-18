<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRenewalAffiliationDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('renewal_affiliation_details', function (Blueprint $table) {
            $table->id();
            $table->string('app_id')->nullable();
            $table->string('course_id')->nullable();
            $table->float('affiliation_fee', 8, 2)->nullable();
            $table->integer('is_approved')->default(0);
            $table->integer('is_paid')->default(0);
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
        Schema::dropIfExists('renewal_affiliation_details');
    }
}
