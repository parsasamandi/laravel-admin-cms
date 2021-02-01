<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEducationTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('education', function(Blueprint $table)
		{
			$table->bigInteger('id', true)->unsigned();
			$table->text('name')->nullable();
			$table->text('degree')->nullable();
			$table->text('GPA')->nullable();
			$table->text('TOEFL')->nullable();
			$table->text('Thesis_topic')->nullable();
			$table->text('education_period')->nullable();
			$table->text('university_desc')->nullable();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('education');
	}

}
