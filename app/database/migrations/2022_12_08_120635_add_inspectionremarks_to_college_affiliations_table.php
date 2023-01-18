<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddInspectionremarksToCollegeAffiliationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('college_affiliations', function (Blueprint $table) {
            $table->text('insp_doc')->nullable();
            $table->text('insp_remarks')->nullable();
            $table->text('affiliation_committee_remarks')->nullable();
            $table->date('affiliation_committee_date')->nullable();
            $table->text('mom')->nullable();
            $table->text('board_of_management_remarks')->nullable();
            $table->date('board_of_management_date')->nullable();
            $table->text('resolution')->nullable();
        });
        Schema::table('infrastructure_details', function (Blueprint $table) {
            $table->text('insp_remarks')->nullable();
        });
        Schema::table('building_details', function (Blueprint $table) {
            $table->string('insp_length')->nullable();
            $table->string('insp_width')->nullable();
            $table->string('insp_area')->nullable();
            $table->string('insp_capacity')->nullable();
            $table->text('insp_remarks')->nullable();
        });
        Schema::table('other_infrastructures', function (Blueprint $table) {
            $table->string('insp_boundary_req_length')->nullable();
            $table->string('insp_boundary_act_length')->nullable();
            $table->string('insp_playground_length')->nullable();
            $table->string('insp_playground_width')->nullable();
            $table->text('insp_game_equipment')->nullable();
            $table->string('insp_guest_hall')->nullable();
            $table->string('insp_conference_hall')->nullable();
            $table->string('insp_auditorium')->nullable();
            $table->string('insp_staff_residence')->nullable();
            $table->string('insp_book')->nullable();
            $table->string('insp_reading_room')->nullable();
            $table->string('insp_magazine')->nullable();
            $table->text('insp_remarks')->nullable();
        });
        Schema::table('teacher_details', function (Blueprint $table) {
            $table->text('insp_remarks')->nullable();
        });
        Schema::table('fd_balances', function (Blueprint $table) {
            $table->string('insp_amount')->nullable();
            $table->text('insp_remarks')->nullable();
        });
        Schema::table('sb_balances', function (Blueprint $table) {
            $table->string('insp_amount')->nullable();
            $table->text('insp_remarks')->nullable();
        });
        Schema::table('ca_balances', function (Blueprint $table) {
            $table->string('insp_amount')->nullable();
            $table->text('insp_remarks')->nullable();
        });
        Schema::table('financial_details', function (Blueprint $table) {
            $table->string('insp_cash_in_hand')->nullable();
            $table->string('insp_other_cash')->nullable();
            $table->text('insp_finance_first_year')->nullable();
            $table->text('insp_finance_second_year')->nullable();
            $table->text('insp_finance_third_year')->nullable();
            $table->text('insp_remarks')->nullable();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('infrastructure_details', function (Blueprint $table) {
            //
        });
    }
}
