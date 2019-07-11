<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateAbilitiesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('abilities', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('name', 150);
			$table->string('title')->nullable();
			$table->integer('entity_id')->unsigned()->nullable();
			$table->string('entity_type', 150)->nullable();
			$table->boolean('only_owned')->default(0);
			$table->integer('scope')->nullable()->index();
			$table->timestamps();
			$table->string('type');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('abilities');
	}

}
