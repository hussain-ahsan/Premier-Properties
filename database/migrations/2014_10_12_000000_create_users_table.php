<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('first_name');
            $table->string('last_name');
            $table->string('address');
            $table->string('city');
            $table->string('state');
            $table->integer('zip');
            $table->string('payment_address');
            $table->string('payment_city');
            $table->string('payment_state');
            $table->string('payment_zip');
            $table->string('home_phone');
            $table->string('cell_phone');
            $table->string('work_phone');
            $table->string('fax_phone');
            $table->string('email')->unique();
            $table->string('email2');
            $table->string('password');
            $table->rememberToken();
            $table->dateTime('password_expire_date');
            $table->integer('created_by')->unsigned();
            $table->dateTime('last_login');
            $table->tinyInteger('status');
            $table->tinyInteger('permanent');
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
        Schema::dropIfExists('users');
    }
}
