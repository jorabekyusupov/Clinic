<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWorkCalendarsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('work_calendars', function (Blueprint $table) {
            $table->integer('id', true);
            $table->date('calendar_date')->unique();
            $table->integer('work_day_sequence')->default(0);
            $table->boolean('is_work_day')->default(false);
            $table->boolean('is_weekend')->default(false);;
            $table->boolean('is_holiday')->default(false);;
            $table->string('holiday_name', 55)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('work_calendars');
    }
}
