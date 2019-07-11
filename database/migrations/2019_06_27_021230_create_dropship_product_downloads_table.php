<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateDropshipProductDownloadsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('dropship_product_downloads', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('user_id');
			$table->integer('dropship_product_id');
			$table->text('url', 65535);
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('dropship_product_downloads');
	}

}
