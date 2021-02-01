<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInterestTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('interest', function(Blueprint $table)
		{
			$table->bigInteger('id', true)->unsigned();
			$table->text('image')->nullable();
			$table->text('image2')->nullable();
			$table->text('image3')->nullable();
			$table->text('image4')->nullable();
			$table->string('desc')->nullable();
			$table->string('desc2')->nullable();
			$table->string('desc3')->nullable();
			$table->string('desc4')->nullable();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('interest');
	}

}
