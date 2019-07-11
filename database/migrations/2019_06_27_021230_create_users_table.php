<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateUsersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('users', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('name');
			$table->string('email')->unique();
			$table->string('password');
			$table->string('remember_token', 100)->nullable();
			$table->timestamps();
			$table->string('gender')->nullable()->comment('性别');
			$table->string('status')->default('inactive')->comment('状态');
			$table->string('provider')->nullable()->comment('第三方登入名称');
			$table->string('provider_id')->nullable()->comment('第三方帐号id');
			$table->string('avatar')->nullable()->comment('头像');
			$table->string('summary')->nullable()->comment('简介');
			$table->string('first_name')->nullable()->comment('姓名');
			$table->string('last_name')->nullable()->comment('姓');
			$table->string('phone_number')->nullable()->comment('电话号码');
			$table->string('country')->nullable()->comment('国家');
			$table->string('address')->nullable()->comment('地址');
			$table->string('zip_code')->nullable()->comment('邮编');
			$table->string('state')->nullable()->comment('州');
			$table->string('role')->default('customer')->comment('角色');
			$table->boolean('is_hot')->default(0);
			$table->boolean('is_dropshipper')->default(0)->comment('是否是分销商');
			$table->index(['role','is_hot']);
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('users');
	}

}
