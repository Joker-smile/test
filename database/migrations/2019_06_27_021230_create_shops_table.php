<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateShopsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('shops', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('user_id')->index();
			$table->string('name')->comment('店铺名');
			$table->text('summary', 65535)->comment('店铺简介');
			$table->string('url')->nullable()->comment('店铺地址');
			$table->string('banner')->nullable()->comment('banner');
			$table->string('tag_line')->nullable()->comment('banner简介');
			$table->string('status')->default('pending')->comment('状态');
			$table->timestamps();
			$table->string('contact')->nullable()->comment('店铺联系人');
			$table->string('phone')->nullable();
			$table->string('email');
			$table->text('social_links', 65535)->nullable();
			$table->text('images', 65535)->nullable()->comment('风格图片');
			$table->string('review_reason')->default('');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('shops');
	}

}
