<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCartsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('carts', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('session_id')->default('')->comment('标示购物车商品唯一性');
			$table->string('user_id')->nullable();
			$table->integer('product_id');
			$table->integer('variant_id');
			$table->integer('quantity');
			$table->integer('price')->comment('该商品的价格');
			$table->integer('total')->comment('商品的总价');
			$table->text('options', 65535)->nullable()->comment('保存商品的一些基础属性');
			$table->timestamps();
			$table->integer('is_selected')->default(1)->comment('用户是否勾选该商品');
			$table->integer('basic_id');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('carts');
	}

}
