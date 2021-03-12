<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReportsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reports', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('form_id')->nullable();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->unsignedBigInteger('status_id');
            $table->unsignedBigInteger('test_speed_id')->nullable();
            $table->unsignedBigInteger('system_id')->nullable();
            $table->string('previous_test_id')->length(512)->nullable();
            $table->date('examination_date')->nullable();
            $table->time('test_time')->nullable();
            $table->string('customer_name')->length(512)->nullable();
            $table->string('tester_name')->length(512)->nullable();
            $table->string('test_address_city')->length(512)->nullable();
            $table->string('test_address')->length(512)->nullable();
            $table->string('report_address')->length(512)->nullable();
            $table->string('report_address_city')->length(512)->nullable();
            $table->string('customer_full_name')->length(512)->nullable();
            $table->string('opposite_side')->length(512)->nullable();
            $table->string('customer_logo')->length(512)->nullable();
            $table->tinyInteger('is_guitar_pick')->default(0);
            $table->tinyInteger('is_program')->default(0);
            $table->tinyInteger('is_contract')->default(0);
            $table->double('vat_in_percent')->nullable();
            $table->integer('floor')->nullable();
            $table->integer('technical_floor')->nullable();
            $table->string('more_systems')->length(512)->nullable();
            $table->integer('number_of_shared_buildings')->nullable();
            $table->integer('parking_levels')->nullable();
            $table->integer('roof_levels')->nullable();
            $table->enum('upper_reservoir',['יש','אין'])->nullable();
            $table->enum('bottom_reservoir',['יש','אין'])->nullable();
            $table->enum('shared_systems_with_additional_buildings',['כן','לא'])->nullable();
            $table->enum('com_areas_in_test',['כן','לא'])->nullable();
            $table->enum('exam_comm_areas',['כן','לא'])->nullable();
            $table->text('resume')->nullable();
            $table->foreign('form_id')->references('id')->on('forms');
            $table->foreign('status_id')->references('id')->on('statuses');
            $table->foreign('test_speed_id')->references('id')->on('test_speeds');
            $table->foreign('system_id')->references('id')->on('systems');
            $table->foreign('user_id')->references('id')->on('users');
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
        Schema::dropIfExists('reports');
    }
}
