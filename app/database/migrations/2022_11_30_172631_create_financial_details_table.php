<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFinancialDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('financial_details', function (Blueprint $table) {
            $table->id();
            $table->string('app_id')->nullable();
            $table->string('finance_first_year')->nullable();
            $table->string('finance_first_income')->nullable();
            $table->string('finance_first_expense')->nullable();
            $table->string('finance_first_balance')->nullable();

            $table->string('finance_second_year')->nullable();
            $table->string('finance_second_income')->nullable();
            $table->string('finance_second_expense')->nullable();
            $table->string('finance_second_balance')->nullable();

            $table->string('finance_third_year')->nullable();
            $table->string('finance_third_income')->nullable();
            $table->string('finance_third_expense')->nullable();
            $table->string('finance_third_balance')->nullable();

            $table->string('cash_in_hand')->nullable();
            $table->date('cash_in_hand_date')->nullable();
            $table->string('other_cash')->nullable();
            $table->enum('apply_status', ['1', '2', '3'])->default('1')->nullable();
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
        Schema::dropIfExists('financial_details');
    }
}
