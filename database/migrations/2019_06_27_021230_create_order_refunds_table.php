<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateOrderRefundsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('order_refunds', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('refund_number')->comment('退款流水号');
			$table->integer('order_id')->comment('订单号');
			$table->integer('order_item_id')->comment('退款产品');
			$table->integer('count')->default(1)->comment('退款产品数量');
			$table->integer('balance')->comment('退款金额');
			$table->string('status')->default('pending')->comment('退款处理状态');
			$table->string('refund_reason')->nullable()->comment('退款原因');
			$table->string('refund_detail')->nullable()->comment('退款详细');
			$table->string('refund_images', 1024)->nullable()->comment('退款图片');
			$table->string('backup')->nullable()->comment('备注');
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
		Schema::drop('order_refunds');
	}

}
