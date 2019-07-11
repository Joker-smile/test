<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateDropshippersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('dropshippers', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('user_id');
			$table->string('first_name')->nullable()->comment('姓名');
			$table->string('last_name')->nullable()->comment('姓');
			$table->string('phone_number')->nullable()->comment('电话号码');
			$table->string('country')->nullable()->comment('国家');
			$table->string('address')->nullable()->comment('地址');
			$table->string('zip_code')->nullable()->comment('邮编');
			$table->string('state')->nullable()->comment('州');
			$table->string('city')->nullable()->comment('城市');
			$table->string('business_pitch')->nullable()->comment('商业宣传');
			$table->string('code3')->nullable()->comment('国家代码');
			$table->text('business_category', 65535)->nullable()->comment('分销类型');
			$table->string('employees')->nullable()->comment('雇员数');
			$table->string('daily_order')->nullable()->comment('日订单');
			$table->string('monthly_sales')->nullable()->comment('月销售额');
			$table->text('use_service_reason', 65535)->nullable()->comment('使用服务原因');
			$table->timestamps();
			$table->string('status')->default('pending')->comment('状态');
			$table->string('business_url')->nullable()->comment('店铺链接');
			$table->string('social_link')->nullable()->comment('社会化链接');
			$table->string('remark')->nullable()->comment('审核备注');
			$table->boolean('designs_review_required')->default(1)->comment('b端设计的产品是否需要审核');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('dropshippers');
	}

}
