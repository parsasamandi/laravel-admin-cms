<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInterestTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('interest', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->mediumText('image')->nullable(true);
            $table->mediumText('image2')->nullable(true);
            $table->mediumText('image3')->nullable(true);
            $table->mediumText('image4')->nullable(true);
            $table->string('desc')->nullable(true);
            $table->string('desc2')->nullable(true);
            $table->string('desc3')->nullable(true);
            $table->string('desc4')->nullable(true);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('interest');
    }
}
