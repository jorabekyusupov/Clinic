<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDoctorSpecialtiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('doctor_specialties', function (Blueprint $table) {
            $table->integer('id', true);
            $table->integer('doctor_id');
            $table->integer('specialty_id');
            $table->date('certificate_taken_date')->nullable();
            $table->date('certificate_due_date')->nullable();
            $table->integer('created_by');
            $table->integer('updated_by')->nullable();
            $table->integer('deleted_by')->nullable();
            $table->timestampTz('updated_at')->nullable();
            $table->timestampTz('created_at')->nullable();
            $table->softDeletes();

            $table->unique(["doctor_id", "specialty_id"], 'doctor_specialties_doctor_id_specialty_id_unique');
            $table->index('doctor_id', 'specialty_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('doctor_specialties', function (Blueprint $table) {
            $table->dropUnique('doctor_specialties_doctor_id_specialty_id_unique');
            $table->dropIndex('doctor_id', 'specialty_id');
        });

        Schema::dropIfExists('doctor_specialties');
    }
}
