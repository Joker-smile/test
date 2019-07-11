<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCouponsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('coupons', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('name')->comment('优惠券名称');
			$table->string('code')->comment('优惠券码');
			$table->string('type')->default('code')->comment('优惠券类型');
			$table->string('rule')->comment('优惠券规则');
			$table->integer('full')->default(0)->comment('满');
			$table->integer('sub')->default(0)->comment('减');
			$table->float('discount')->default(1.00)->comment('折扣');
			$table->text('basics', 65535)->nullable()->comment('小品类');
			$table->text('categories', 65535)->nullable()->comment('大品类');
			$table->text('products', 65535)->nullable()->comment('商品');
			$table->timestamp('start_time')->default(DB::raw('CURRENT_TIMESTAMP'))->comment('开始时间');
			$table->dateTime('end_time')->nullable();
			$table->integer('frequency')->comment('总次数');
			$table->integer('surplus')->comment('剩余次数');
			$table->string('backup')->nullable()->comment('备注');
			$table->string('status')->default('approve')->comment('优惠券状态');
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
		Schema::drop('coupons');
	}

}
