<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePermissionsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('permissions', function(Blueprint $table)
		{
			$table->integer('ability_id')->unsigned()->index();
			$table->integer('entity_id')->unsigned();
			$table->string('entity_type', 150);
			$table->boolean('forbidden')->default(0);
			$table->integer('scope')->nullable()->index();
			$table->index(['entity_id','entity_type','scope'], 'permissions_entity_index');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('permissions');
	}

}
