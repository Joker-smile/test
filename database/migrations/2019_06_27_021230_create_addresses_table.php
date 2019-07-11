<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateAddressesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('addresses', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('user_id')->nullable()->comment('用户ID');
			$table->string('first_name')->nullable()->comment('姓名');
			$table->string('last_name')->nullable()->comment('姓');
			$table->string('phone_number')->nullable()->comment('电话号码');
			$table->string('country_id')->nullable()->comment('国家ID');
			$table->string('type')->default('shipping_address')->comment('类型');
			$table->string('address')->nullable()->comment('地址');
			$table->string('zip_code')->nullable()->comment('邮编');
			$table->string('state')->nullable()->comment('州');
			$table->string('city')->nullable()->comment('城市');
			$table->string('email')->default('')->comment('邮件');
			$table->integer('is_default')->default(0);
			$table->timestamps();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('addresses');
	}

}
