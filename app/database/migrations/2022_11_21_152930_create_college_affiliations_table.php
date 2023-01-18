<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCollegeAffiliationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('college_affiliations', function (Blueprint $table) {
            $table->id();
            $table->string('app_ref_no')->nullable();
            $table->string('clg_name')->nullable();
            $table->text('affiliation_category')->nullable();
            $table->date('applied_date')->nullable();
            $table->string('email')->nullable();
            $table->string('mob_no')->nullable();
            $table->string('social_welfare')->nullable();
            $table->string('welfare_name')->nullable();
            $table->string('welfare_reg_no')->nullable();
            $table->string('welfare_cert')->nullable();
            $table->string('app_slug')->nullable();
            $table->enum('payment_status', ['0', '1'])->default('1');
            $table->integer('status')->default(0);
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
        Schema::dropIfExists('college_affiliations');
    }
}
