<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateVariantsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('variants', function(Blueprint $table)
		{
			$table->increments('id');
			$table->text('values', 65535);
			$table->integer('product_id')->index();
			$table->text('image', 65535)->nullable();
			$table->integer('basic_id');
			$table->integer('option_id');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('variants');
	}

}
