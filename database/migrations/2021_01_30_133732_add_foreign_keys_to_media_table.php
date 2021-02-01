<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToMediaTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('media', function(Blueprint $table)
		{
			$table->foreign('desc_id', 'description_ibfk')->references('id')->on('description')->onUpdate('CASCADE')->onDelete('CASCADE');
			$table->foreign('mediaText_id', 'media_ibfk_1')->references('id')->on('media_text')->onUpdate('CASCADE')->onDelete('CASCADE');
			$table->foreign('project_id', 'project_ibfk_4')->references('id')->on('project')->onUpdate('CASCADE')->onDelete('CASCADE');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('media', function(Blueprint $table)
		{
			$table->dropForeign('description_ibfk');
			$table->dropForeign('media_ibfk_1');
			$table->dropForeign('project_ibfk_4');
		});
	}

}
