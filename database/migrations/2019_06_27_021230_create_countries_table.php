<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCountriesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('countries', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('name')->comment('国家中文名称');
			$table->string('country')->comment('国家英文名称');
			$table->string('code')->comment('国家代码');
			$table->integer('zone')->comment('地区编号');
			$table->string('status')->default('approve')->comment('上架状态');
			$table->string('code3')->comment('三位国家代码');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('countries');
	}

}
