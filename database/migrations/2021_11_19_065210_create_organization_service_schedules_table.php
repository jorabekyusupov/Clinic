<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrganizationServiceSchedulesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('organization_service_schedules', function (Blueprint $table) {
            $table->integer('id', true);
            $table->integer('organization_id');
            $table->integer('service_id');
            $table->date('calendar_date');
            $table->integer('doctor_id')->nullable();
            $table->integer('organization_equipment_id')->nullable();
            $table->char('start_time',5)->comment('08:00, 12:50, ...');
            $table->char('end_time',5)->comment('08:00, 12:50, ...');
            $table->integer('type')->default(0)->comment('0-to`liq ish kuni, 1 - dam olish kuni, 2 - bayram kuni');
            $table->timestampTz('created_at')->nullable();
            $table->integer('created_by')->nullable();
            $table->timestampTz('updated_at')->nullable();
            $table->integer('updated_by')->nullable();
            $table->index(['organization_id','service_id','doctor_id','organization_equipment_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('organization_service_schedules');
    }
}
