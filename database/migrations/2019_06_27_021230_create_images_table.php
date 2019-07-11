<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateImagesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('images', function(Blueprint $table)
		{
			$table->increments('id');
			$table->timestamps();
			$table->string('url');
			$table->integer('user_id')->unsigned()->nullable();
			$table->string('type')->default('artwork');
			$table->string('info')->nullable();
			$table->dateTime('deleted_at')->default('2016-06-06 00:00:00');
			$table->string('title')->nullable();
			$table->text('description', 65535)->nullable();
			$table->string('reviewing_status')->default('waiting')->comment('审核状态');
			$table->integer('category_id')->nullable()->comment('类别id');
			$table->boolean('is_show')->default(0);
			$table->string('hash', 32)->default('');
			$table->string('platform')->default('customer');
			$table->index(['user_id','hash']);
			$table->index(['reviewing_status','is_show','deleted_at']);
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('images');
	}

}
