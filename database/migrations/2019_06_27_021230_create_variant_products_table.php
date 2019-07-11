<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateVariantProductsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('variant_products', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('name');
			$table->integer('basic_id');
			$table->text('product_ids', 65535);
			$table->text('image', 65535);
			$table->timestamps();
			$table->integer('user_id');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('variant_products');
	}

}
