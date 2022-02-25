<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrganizationDoctorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('organization_doctors', function (Blueprint $table) {
            $table->integer('id', true);
            $table->integer('organization_id');
            $table->integer('doctor_id');
            $table->timestampTz('created_at')->nullable();
            $table->integer('created_by')->nullable();
            $table->timestampTz('updated_at')->nullable();
            $table->integer('updated_by')->nullable();
            $table->softDeletes();
            $table->integer('deleted_by')->nullable();

            $table->unique(["doctor_id", "organization_id"], 'organization_doctors_doctor_id_organization_id_unique');
            $table->index('organization_id', 'doctor_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('organization_doctors', function (Blueprint $table) {
            $table->dropUnique('organization_doctors_doctor_id_organization_id_unique');
            $table->dropIndex('organization_id', 'doctor_id');
        });
        Schema::dropIfExists('organization_doctors');
    }
}
