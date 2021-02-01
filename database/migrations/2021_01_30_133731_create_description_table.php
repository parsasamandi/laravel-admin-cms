<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDescriptionTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('description', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->text('desc')->nullable();
			$table->integer('project_id')->nullable()->index('project_id');
			$table->integer('experience_id')->nullable()->index('experience_id');
			$table->integer('size')->nullable();
			$table->integer('publication_id')->nullable()->index('publication_ibfk_1_idx');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('description');
	}

}
