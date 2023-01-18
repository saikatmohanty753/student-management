<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRenewalAffiliationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('renewal_affiliations', function (Blueprint $table) {
            $table->id();
            $table->string('app_ref_no')->nullable();
            $table->string('clg_id')->nullable();
            $table->string('affiliation_category')->default('renewal');
            $table->date('applied_date')->nullable();
            $table->enum('payment_status', ['0', '1'])->default('0');
            $table->text('invoice_no')->nullable();
            $table->integer('status')->default(0);
            $table->integer('academic_status')->default(0);
            $table->text('academic_remarks')->nullable();
            $table->integer('registrar_status')->default(0);
            $table->text('registrar_remarks')->nullable();
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
        Schema::dropIfExists('renewal_affiliations');
    }
}
