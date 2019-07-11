<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateOrderItemsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('order_items', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('order_id')->comment('订单ID');
			$table->integer('product_id')->comment('商品ID');
			$table->integer('variant_id')->comment('商品变体ID');
			$table->integer('quantity')->comment('数量');
			$table->integer('unit_price')->comment('单价');
			$table->integer('units_total')->comment('总价');
			$table->integer('adjustments_total')->comment('调整价格');
			$table->integer('shop_id')->nullable()->comment('店铺ID');
			$table->text('product_snapshot')->nullable()->comment('商品快照');
			$table->text('extras', 65535)->nullable();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('order_items');
	}

}
