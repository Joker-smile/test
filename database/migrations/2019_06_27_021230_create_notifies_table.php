<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateNotifiesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('notifies', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('uuid')->comment('消息的uuid');
			$table->text('content', 65535)->comment('消息内容');
			$table->string('type')->comment('消息类型');
			$table->integer('target_id')->nullable()->comment('目标ID');
			$table->string('target_type')->nullable()->comment('目标类型');
			$table->string('action')->nullable()->comment('动作');
			$table->integer('sender_id')->nullable()->comment('源ID');
			$table->string('sender_type')->nullable()->comment('源type');
			$table->integer('is_read')->default(0)->comment('是否阅读');
			$table->integer('user_id')->nullable()->comment('所属用户');
			$table->integer('quote_id')->unsigned()->nullable();
			$table->string('quote_type')->nullable();
			$table->timestamps();
			$table->string('title')->nullable();
			$table->string('platform')->default('customer')->comment('平台');
			$table->index(['quote_id','quote_type']);
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('notifies');
	}

}
