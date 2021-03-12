<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAreaProblemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('area_problems', function (Blueprint $table) {
            $table->unsignedBigInteger('report_area_id');
            $table->unsignedBigInteger('problem_id');
            $table->foreign('report_area_id')->references('id')->on('report_areas');
            $table->foreign('problem_id')->references('id')->on('problems');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('area_problems');
    }
}
