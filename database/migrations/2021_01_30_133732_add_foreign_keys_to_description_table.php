<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToDescriptionTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('description', function(Blueprint $table)
		{
			$table->foreign('experience_id', 'experience')->references('id')->on('experience')->onUpdate('CASCADE')->onDelete('CASCADE');
			$table->foreign('project_id', 'project_ibfk_1')->references('id')->on('project')->onUpdate('CASCADE')->onDelete('CASCADE');
			$table->foreign('publication_id', 'publication_ibfk_1')->references('id')->on('description')->onUpdate('CASCADE')->onDelete('CASCADE');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('description', function(Blueprint $table)
		{
			$table->dropForeign('experience');
			$table->dropForeign('project_ibfk_1');
			$table->dropForeign('publication_ibfk_1');
		});
	}

}
