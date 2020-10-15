<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMediaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('media', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->Text('media_url')->nullable(true);
            $table->integer('type')->nullable(true);
            $table->integer('size')->nullable(true); // must be required in input field
            $table->foreign('mediaText_id')->references('mediaText_id')->on('media_text');
            $table->foreign('project_id')->references('project_id')->on('project');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('media');
    }
}
