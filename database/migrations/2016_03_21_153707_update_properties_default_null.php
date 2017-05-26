<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdatePropertiesDefaultNull extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('properties', function ($table) {
            $table->string('zip')->change()->nullable()->default('');
            $table->string('lender')->change()->nullable()->default('');
            $table->string('interest_rate')->change()->nullable()->default('');
            $table->string('mezz_interest_rate')->change()->nullable()->default('');
            $table->string('refinance_interest_rate')->change()->nullable()->default('');
            $table->string('irr')->change()->nullable()->default('');
            $table->string('holding_period')->change()->nullable()->default('');
            $table->string('roi')->change()->nullable()->default('');
            $table->string('original_debt')->change()->nullable()->default('');
            $table->string('original_equity_investment')->change()->nullable()->default('');
            $table->string('current_equity_balance')->change()->nullable()->default('');
            $table->string('purchased_price')->change()->nullable()->default('');
            $table->string('refinance_loan_amount')->change()->nullable()->default('');
            $table->string('original_occupancy_rate')->change()->nullable()->default('');
            $table->string('current_occupancy_rate')->change()->nullable()->default('');
            $table->string('block_lot')->change()->nullable()->default('');
            $table->string('block_lot')->change()->nullable()->default('');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
    }
}
