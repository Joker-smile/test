<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateStorePlatformsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('store_platforms', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('name');
			$table->string('logo');
			$table->text('open_for_users', 65535)->nullable()->comment('开放访问用户');
			$table->boolean('supports_orders_import')->default(0)->comment('是否支持订单导入');
			$table->boolean('has_default_products_export')->default(0)->comment('是否有默认的分销商品导出表格');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('store_platforms');
	}

}
