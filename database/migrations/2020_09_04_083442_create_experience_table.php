<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateExperienceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('experience', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title')->nullable(true);
            $table->string('desc1')->nullable(true);
            $table->string('desc2')->nullable(true);
            $table->string('desc3')->nullable(true);
            $table->string('desc4')->nullable(true);
            $table->string('desc5')->nullable(true);
            $table->string('desc6')->nullable(true);
            $table->string('desc7')->nullable(true);
            $table->string('desc8')->nullable(true);
            $table->string('desc9')->nullable(true);
            $table->string('desc10')->nullable(true);
            $table->mediumText('image')->nullable(true);
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('experience');
    }
}
