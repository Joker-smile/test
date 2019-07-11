<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateBankTransfersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('bank_transfers', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('user_id');
			$table->string('sender_name')->comment('转账人名称');
			$table->string('transfer_id')->nullable()->comment('交易id');
			$table->string('amount')->comment('金额');
			$table->string('beneficiary_type')->default('USD')->comment('收益类型');
			$table->string('transfer_sheet')->nullable()->comment('交易流水');
			$table->timestamps();
			$table->string('status')->default('pending')->comment('状态');
			$table->string('review_reason')->default('');
			$table->integer('order_id')->default(0);
			$table->integer('payment_id')->default(0);
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('bank_transfers');
	}

}
