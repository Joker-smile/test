<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateBasicsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('basics', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('name');
			$table->string('code');
			$table->string('thumb');
			$table->text('content', 65535)->nullable();
			$table->timestamps();
			$table->text('standard_mode', 65535);
			$table->text('easy_mode', 65535);
			$table->string('size_image')->nullable();
			$table->string('color_image')->nullable();
			$table->string('status')->default('active');
			$table->integer('sort')->default(0);
			$table->text('logistics', 65535)->nullable();
			$table->integer('amazon_template_id')->default(0);
			$table->string('production_cycle')->comment('生产时间');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('basics');
	}

}
