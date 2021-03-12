<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProblemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('problems', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('profession_id');
            $table->string('details_of_eclipse')->length(512)->nullable();
            $table->string('solution')->length(512)->nullable();
            $table->string('image')->length(512)->nullable();
            $table->float('cost')->nullable();
            $table->foreign('profession_id')->references('id')->on('professions');
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
        Schema::dropIfExists('problems');
    }
}
