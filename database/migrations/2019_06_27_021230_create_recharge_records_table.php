<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateRechargeRecordsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('recharge_records', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('user_id');
			$table->string('recharge_number')->comment('充值number');
			$table->string('status')->default('waiting')->comment('充值状态');
			$table->integer('recharge_amount')->default(0)->comment('充值金额');
			$table->integer('bonus_amount')->default(0)->comment('赠送金额');
			$table->string('pay_type')->comment('充值类型');
			$table->timestamps();
			$table->string('review_reason')->default('');
			$table->integer('success_payment_id')->default(0);
			$table->string('recharge_sheet')->nullable()->comment('交易图片');
			$table->integer('before')->default(0)->comment(' 充值之前账户余额');
			$table->integer('after')->default(0)->comment('充值之后账户余额');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('recharge_records');
	}

}
