<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePackagesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('packages', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('package_number')->comment('包裹编号');
			$table->integer('order_id')->comment('订单号');
			$table->string('shipping_carrier')->nullable()->comment('承运商');
			$table->string('shipping_number')->nullable()->comment('运单号');
			$table->timestamps();
			$table->integer('no')->comment('包裹序号');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('packages');
	}

}
