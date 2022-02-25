<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWeeklyScheduleTranslationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('weekly_schedule_translations', function (Blueprint $table) {
            $table->integer('id', true);
            $table->integer('weekly_schedule_id');
            $table->string('language_code', 10);
            $table->string('name')->nullable();
            $table->index('weekly_schedule_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('weekly_schedule_translations', function (Blueprint $table) {
            $table->dropIndex('weekly_schedule_id');
        });
        Schema::dropIfExists('weekly_schedule_translations');
    }
}
