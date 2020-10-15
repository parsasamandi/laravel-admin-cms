<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEducationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('education', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->text('name')->nullable(true);
            $table->text('degree')->nullable(true);
            $table->text('GPA')->nullable(true);
            $table->text('TOEFL')->nullable(true);
            $table->text('Thesis_topic')->nullable(true);
            $table->text('education_period')->nullable(true);
            $table->text('university_desc')->nullable(true);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('education');
    }
}
