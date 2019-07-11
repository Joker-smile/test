<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePaymentsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('payments', function(Blueprint $table)
		{
			$table->bigInteger('id', true)->unsigned();
			$table->text('details', 65535)->nullable();
			$table->string('number');
			$table->string('description')->default('');
			$table->integer('user_id')->nullable();
			$table->string('user_email')->default('');
			$table->string('total_amount');
			$table->string('currency_code');
			$table->string('status')->default('waiting');
			$table->timestamps();
			$table->string('order_number');
			$table->string('method')->comment('订单付款方式');
			$table->string('payment_type')->default('order');
			$table->text('handler', 65535)->nullable()->comment('支付成功的处理器');
			$table->string('entity')->nullable();
			$table->integer('transaction_id')->default(0);
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('payments');
	}

}
