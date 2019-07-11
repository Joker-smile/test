<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateProductsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('products', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('name')->comment('Product name');
			$table->text('description', 65535);
			$table->integer('user_id')->unsigned()->default(0)->index()->comment('Product  designer');
			$table->integer('basic_id')->unsigned()->index();
			$table->string('status')->default('active')->comment('Product state');
			$table->string('type')->default('private')->comment('Product  type ');
			$table->timestamps();
			$table->dateTime('deleted_at')->default('2016-06-06 00:00:00');
			$table->text('images', 65535);
			$table->string('reviewing_status')->nullable()->default('waiting')->comment('审核状态');
			$table->boolean('is_hot')->default(0)->comment('是否热门');
			$table->string('review_failed_reason')->nullable();
			$table->string('punishment')->nullable();
			$table->text('prints', 65535);
			$table->boolean('distributable')->default(0);
			$table->string('platform')->default('customer');
			$table->string('images_status')->default('completed');
			$table->string('usage')->default('sale');
			$table->integer('image_id')->default(0)->index();
			$table->integer('sort')->default(0)->index()->comment('排序');
			$table->index(['type','user_id','deleted_at']);
			$table->index(['type','is_hot','deleted_at']);
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('products');
	}

}
