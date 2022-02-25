<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDoctorStudiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('doctor_studies', function (Blueprint $table) {
            $table->integer('id', true);
            $table->integer('doctor_id');
            $table->integer('study_type_id');
            $table->integer('university_id')->nullable();
            $table->integer('study_degree_id')->nullable();
            $table->integer('specialty_id')->nullable();
            $table->string('direction',255)->nullable();
            $table->string('description',255)->nullable();
            $table->integer('began_year');
            $table->integer('graduated_year');
            $table->integer('created_by');
            $table->integer('updated_by')->nullable();
            $table->integer('deleted_by')->nullable();
            $table->timestampTz('updated_at')->nullable();
            $table->timestampTz('created_at')->nullable();
            $table->softDeletes();
            $table->index(['doctor_id', 'study_type_id', 'university_id', 'study_degree_id', 'specialty_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('organization_translations', function (Blueprint $table) {
            $table->dropIndex('doctor_id', 'study_type_id', 'university_id', 'study_degree_id', 'specialty_id');
        });
        Schema::dropIfExists('doctor_studies');
    }
}
