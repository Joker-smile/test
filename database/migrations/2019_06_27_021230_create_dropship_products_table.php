<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateDropshipProductsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('dropship_products', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('user_id');
			$table->integer('product_id');
			$table->timestamps();
			$table->integer('image_id');
			$table->string('name');
			$table->text('images', 65535);
			$table->text('prints', 65535);
			$table->integer('basic_id');
			$table->integer('designer_id')->comment('设计者的ＩＤ');
			$table->text('description', 65535);
			$table->string('platform');
			$table->integer('parent_product')->default(0);
			$table->integer('is_variant')->default(0);
			$table->dateTime('deleted_at')->default('2016-06-06 00:00:00');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('dropship_products');
	}

}
