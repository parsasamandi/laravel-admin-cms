<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSkillTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('skill', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title')->nullable(true);
            $table->string('desc')->nullable(true);
            $table->string('desc2')->nullable(true);
            $table->string('desc3')->nullable(true);
            $table->string('title2')->nullable(true);
            $table->string('desc4')->nullable(true);
            $table->string('desc5')->nullable(true);
            $table->string('desc6')->nullable(true);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('skill');
    }
}
