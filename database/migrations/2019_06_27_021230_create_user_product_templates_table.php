<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateUserProductTemplatesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('user_product_templates', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('user_id')->default(0);
			$table->integer('amazon_template_id')->default(0);
			$table->string('name');
			$table->text('columns', 65535);
			$table->timestamps();
			$table->integer('store_id');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('user_product_templates');
	}

}
