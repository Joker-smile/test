<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateOrderExportsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('order_exports', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('admin_id');
			$table->integer('total');
			$table->integer('success');
			$table->text('order_ids');
			$table->string('status')->default('pending');
			$table->string('download_url')->nullable();
			$table->string('backup')->nullable()->comment('备注');
			$table->string('export_template')->comment('订单导出模板');
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
		Schema::drop('order_exports');
	}

}
