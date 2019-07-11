<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateBalancePaymentsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('balance_payments', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('order_group_id')->comment('订单组id');
			$table->integer('user_id');
			$table->string('group_number')->comment('订单组号');
			$table->string('total')->comment('总价');
			$table->string('payment_status')->default('waiting')->comment('支付状态');
			$table->timestamps();
			$table->integer('pay_before_balance')->default(0)->comment('支付之前账户余额');
			$table->integer('pay_after_balance')->default(0)->comment('支付之后账户余额');
			$table->string('remark')->default('')->comment('备注');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('balance_payments');
	}

}
