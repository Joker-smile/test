<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTaggableTaggablesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('taggable_taggables', function(Blueprint $table)
		{
			$table->integer('tag_id')->unsigned();
			$table->integer('taggable_id')->unsigned();
			$table->string('taggable_type')->index('i_taggable_type');
			$table->timestamps();
			$table->index(['tag_id','taggable_id'], 'i_taggable_fwd');
			$table->index(['taggable_id','tag_id'], 'i_taggable_rev');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('taggable_taggables');
	}

}
