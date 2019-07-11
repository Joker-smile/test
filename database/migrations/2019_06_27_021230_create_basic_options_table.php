<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateBasicOptionsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('basic_options', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('basic_id')->unsigned()->index('options_basic_id_index');
			$table->text('values', 65535);
			$table->integer('cost')->comment('生产成本价格');
			$table->integer('business_cost')->comment('分销商白板价格');
			$table->integer('recommend_price')->comment('推荐出售价格');
			$table->integer('business_recommend_price')->comment('分销商推荐出售价格');
			$table->integer('business_design_cost')->default(0);
			$table->integer('sort')->default(0);
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('basic_options');
	}

}
