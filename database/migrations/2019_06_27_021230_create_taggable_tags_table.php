<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTaggableTagsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('taggable_tags', function(Blueprint $table)
		{
			$table->increments('tag_id');
			$table->string('name');
			$table->string('normalized')->index();
			$table->timestamps();
			$table->integer('category_id')->default(0);
			$table->string('type')->nullable()->default('product');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('taggable_tags');
	}

}
