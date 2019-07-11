<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateDropshipProductVariantsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('dropship_product_variants', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('customer_custom_recommend_price');
			$table->integer('business_custom_recommend_price');
			$table->integer('basic_id');
			$table->integer('option_id');
			$table->integer('dropship_product_id');
			$table->integer('original_product_id');
			$table->text('values', 65535);
			$table->string('custom_sku')->default('');
			$table->integer('user_id')->default(0);
			$table->index(['user_id','custom_sku']);
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('dropship_product_variants');
	}

}
