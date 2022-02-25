<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSpecialtiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('specialties', function (Blueprint $table) {
            $table->integer('id', true);
            $table->integer('created_by')->nullable();
            $table->timestampTz('created_at')->nullable();
            $table->integer('specialty_type_id')->nullable();
            $table->integer('updated_by')->nullable();
            $table->timestampTz('updated_at')->nullable();
            $table->softDeletes();
            $table->integer('deleted_by')->nullable();
            $table->index('specialty_type_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('specialties', function (Blueprint $table) {
            $table->dropIndex('specialty_type_id');
        });
        Schema::dropIfExists('specialties');
    }
}
