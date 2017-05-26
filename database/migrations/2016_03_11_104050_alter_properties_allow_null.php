<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterPropertiesAllowNull extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('properties', function (Blueprint $table) {
            $table->string('name')->change()->nullable();
            $table->string('city')->change()->nullable();
            $table->string('state')->change()->nullable();
            $table->integer('zip')->change()->nullable();
            $table->string('lender')->change()->nullable();
            $table->float('interest_rate')->change()->nullable();
            $table->string('rate_structure')->change()->nullable();
            $table->string('mezz_lender')->change()->nullable();
            $table->float('mezz_interest_rate')->change()->nullable();
            $table->dateTime('refinance_date')->change()->nullable();
            $table->float('refinance_loan_amount')->change()->nullable();
            $table->float('refinance_interest_rate')->change()->nullable();
            $table->float('irr')->change()->nullable();
            $table->float('holding_period')->change()->nullable();
            $table->float('roi')->change()->nullable();
            $table->float('original_debt')->change()->nullable();
            $table->float('original_equity_investment')->change()->nullable();
            $table->float('current_equity_balance')->change()->nullable();
            $table->float('purchased_price')->change()->nullable();
            $table->float('original_occupancy_rate')->change()->nullable();
            $table->float('current_occupancy_rate')->change()->nullable();
            $table->float('block_lot')->change()->nullable();
            $table->dateTime('date_purchase')->change()->nullable();
            $table->dateTime('year_built_renovated')->change()->nullable();
            $table->string('lot_area')->change()->nullable();
            $table->string('building_type')->change()->nullable();
            $table->string('building_class')->change()->nullable();
            $table->string('market')->change()->nullable();
            $table->string('stories')->change()->nullable();
            $table->string('description_investment_property')->change()->nullable();
            $table->string('property_investment_status')->change()->nullable();
            $table->string('image')->change()->nullable();
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
