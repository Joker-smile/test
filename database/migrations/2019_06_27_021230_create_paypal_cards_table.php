<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePaypalCardsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('paypal_cards', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('user_id')->comment('用户id');
			$table->string('paypal_email')->comment('paypal帐号');
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
		Schema::drop('paypal_cards');
	}

}
