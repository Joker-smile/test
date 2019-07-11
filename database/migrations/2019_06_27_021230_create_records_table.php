<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateRecordsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('records', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('identity');
			$table->string('role');
			$table->string('remark');
			$table->integer('recordable_id')->unsigned()->nullable();
			$table->string('recordable_type')->nullable();
			$table->timestamps();
			$table->string('client_ip')->comment('操作者IP');
			$table->string('type')->default('default')->comment('记录类型');
			$table->string('extras')->nullable()->comment('上下文信息');
			$table->index(['recordable_id','recordable_type']);
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('records');
	}

}
