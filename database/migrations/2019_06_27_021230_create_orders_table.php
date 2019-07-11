<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateOrdersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('orders', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('order_number')->comment('订单号');
			$table->text('shipping_address', 65535)->comment('物流地址ID');
			$table->integer('user_id')->nullable()->comment('用户ID');
			$table->string('status')->default('pending')->comment('订单状态');
			$table->integer('items_total')->comment('商品总价');
			$table->integer('adjustments_total')->comment('调整价格');
			$table->string('reviewing_status')->default('waiting')->comment('审核状态');
			$table->string('payment_status')->default('waiting')->comment('支付状态');
			$table->string('shipping_status')->nullable()->comment('物流状态');
			$table->string('notes')->nullable()->comment('订单备注');
			$table->timestamps();
			$table->integer('shipping_fee')->default(0);
			$table->string('financial_status')->default('waiting')->comment('财务审核状态');
			$table->text('cause_of_complaint', 65535)->nullable()->comment('投诉原因');
			$table->integer('is_expedited')->default(0)->comment('是否加急');
			$table->integer('group_id')->nullable()->default(0)->comment('订单组ID');
			$table->integer('coupon_id')->nullable();
			$table->string('shipping_carrier')->default('EMS')->comment('承运商');
			$table->dateTime('payment_at')->nullable()->comment('支付时间');
			$table->string('sync_id')->nullable()->default('')->comment('同步结果id');
			$table->integer('success_payment_id')->default(0);
			$table->dateTime('shipping_at')->nullable();
			$table->string('type')->default('normal')->comment('订单类型');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('orders');
	}

}
