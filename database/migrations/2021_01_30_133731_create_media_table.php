<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMediaTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('media', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->text('media_url')->nullable();
			$table->integer('type')->nullable();
			$table->integer('mediaText_id')->nullable()->index('mediaText_id');
			$table->integer('desc_id')->nullable()->index('desc_id');
			$table->integer('project_id')->nullable()->index('project_id');
			$table->integer('twoInRow')->nullable();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('media');
	}

}
