<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTransactionsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('transactions', function(Blueprint $table)
		{
			$table->bigInteger('id', true)->unsigned();
			$table->integer('user_id');
			$table->string('amount')->comment('发生额');
			$table->integer('before')->default(0)->comment('支付之前账户余额');
			$table->integer('after')->default(0)->comment('支付之后账户余额');
			$table->string('type')->default('recharge')->comment('发生额类型');
			$table->string('remark')->default('')->comment('备注');
			$table->string('user_type')->default('dropshipper')->comment('用户类型');
			$table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('transactions');
	}

}
