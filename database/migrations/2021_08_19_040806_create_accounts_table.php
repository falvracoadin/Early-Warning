<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAccountsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('accounts', function (Blueprint $table) {
            $table->id();
            $table->string('customer_identifier');
            $table->string('account_identifier');
            $table->date('position_date');
            $table->unsignedInteger('days_past_due_current');
            $table->unsignedInteger('days_past_due_next_month');
            $table->unsignedInteger('core_kolektibilitas_current');
            $table->unsignedInteger('core_kolektibilitas_next_month');
            $table->unsignedInteger('bikolektibilitas_current');
            $table->unsignedInteger('bikolektibilitas_next_month');
            $table->unsignedInteger('segment_psak_id');
            $table->string('segment_psak_desc');
            $table->unsignedInteger('rating_pool_id');
            $table->string('rating_pool_desc');
            $table->unsignedInteger('loan_due_date');
            $table->unsignedBigInteger('total_amount_disburse');
            $table->unsignedBigInteger('loan_outstanding');
            $table->unsignedBigInteger('baki_debit');
            $table->unsignedBigInteger('carrying_amount');
            $table->unsignedInteger('tenor');
            $table->string('default_flag');
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
        Schema::dropIfExists('accounts');
    }
}
