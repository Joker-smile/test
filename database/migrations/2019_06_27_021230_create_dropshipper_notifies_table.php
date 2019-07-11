<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateDropshipperNotifiesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('dropshipper_notifies', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('user_id');
			$table->integer('order_group_paid')->default(1)->comment('订单组支付通知');
			$table->integer('insufficient_balance')->default(1)->comment('余额不足通知');
			$table->integer('order_status_change')->default(1)->comment('订单状态改变通知');
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
		Schema::drop('dropshipper_notifies');
	}

}
