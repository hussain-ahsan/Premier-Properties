<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePropertiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('properties', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('city');
            $table->string('state');
            $table->integer('zip');
            $table->string('lender');
            $table->float('interest_rate');
            $table->string('rate_structure');
            $table->string('mezz_lender');
            $table->float('mezz_interest_rate');
            $table->dateTime('refinance_date');
            $table->float('refinance_loan_amount');
            $table->float('refinance_interest_rate');
            $table->float('irr');
            $table->float('holding_period');
            $table->float('roi');
            $table->float('original_debt');
            $table->float('original_equity_investment');
            $table->float('current_equity_balance');
            $table->float('purchased_price');
            $table->float('original_occupancy_rate');
            $table->float('current_occupancy_rate');
            $table->float('block_lot');
            $table->dateTime('date_purchase');
            $table->dateTime('year_built_renovated');
            $table->string('lot_area');
            $table->string('building_type');
            $table->string('building_class');
            $table->integer('managed_by')->unsigned();
            $table->foreign('managed_by')->references('id')->on('users');
            $table->string('market');
            $table->string('stories');
            $table->string('description_investment_property');
            $table->string('property_investment_status');
            $table->string('image');
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
        Schema::dropIfExists('properties');
    }
}
