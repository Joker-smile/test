<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCommentsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('comments', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('user_id')->unsigned()->default(0)->comment('用户id');
			$table->integer('product_id')->unsigned()->comment('产品id');
			$table->string('order_id')->comment('订单号');
			$table->integer('merchandise_rank')->unsigned()->comment('商品星级');
			$table->integer('artist_rank')->unsigned()->comment('设计星级');
			$table->text('merchandise_comment', 65535)->comment('商品评论');
			$table->timestamps();
			$table->text('images', 65535)->nullable()->comment('图片');
			$table->integer('artist_id');
			$table->integer('order_item_id');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('comments');
	}

}
