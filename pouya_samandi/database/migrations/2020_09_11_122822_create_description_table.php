<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDescriptionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('description', function (Blueprint $table) {
            $table->bigIncrements('desc_id');
            $table->text('desc')->nullable(true);
            $table->text('desc2')->nullable(true);
            $table->text('desc3')->nullable(true);
            $table->text('desc4')->nullable(true);
            $table->text('desc5')->nullable(true);
            $table->text('desc6')->nullable(true);
            $table->text('desc7')->nullable(true);
            $table->text('desc8')->nullable(true);
            $table->text('desc9')->nullable(true);
            $table->text('desc10')->nullable(true);
            $table->foreign('project_id')->references('project_id')->on('project')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('description');
    }
}
