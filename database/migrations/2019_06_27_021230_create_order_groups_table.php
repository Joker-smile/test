<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateOrderGroupsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('order_groups', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('user_id')->comment('分销商ID');
			$table->string('friendly_name')->nullable()->comment('订单组的名称');
			$table->string('payment_status')->comment('支付状态');
			$table->string('shipping_status')->comment('物流状态');
			$table->integer('shipping_fee')->comment('物流费用');
			$table->integer('items_total')->comment('商品总价');
			$table->integer('adjustments_total')->default(0)->comment('优惠价格');
			$table->string('source')->nullable()->comment('来源');
			$table->timestamps();
			$table->string('group_number');
			$table->string('status')->default('pending');
			$table->integer('success_payment_id')->default(0);
			$table->string('financial_status')->default('waiting')->comment('财务审核');
			$table->integer('store_id')->default(0)->comment('店铺ID');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('order_groups');
	}

}
