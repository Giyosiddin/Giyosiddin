<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStandartsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('standarts', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('profession_id');
            $table->text('fault');
            $table->text('what_to_do');
            $table->text('standart');
            $table->string('image');
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
        Schema::dropIfExists('standarts');
    }
}
