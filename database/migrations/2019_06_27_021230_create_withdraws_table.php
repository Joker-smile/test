<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateWithdrawsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('withdraws', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('user_id')->comment('用户id');
			$table->string('type')->default('paypal')->comment('类型');
			$table->string('withdraw_status')->default('waiting')->comment('审核状态');
			$table->integer('is_handle')->default(0)->comment('是否处理');
			$table->timestamps();
			$table->string('paypal_email')->comment('paypal帐号');
			$table->float('withdraw_balance')->comment('提现金额');
			$table->float('wallet_after')->comment('提现后钱包金额');
			$table->string('remark')->default('')->comment('标记');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('withdraws');
	}

}
