<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePicturesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pictures', function (Blueprint $table) {
            $table->integer('id', true);
            $table->string('object_type')->comment('doctor,organization,patient,user,doctor_study');
            $table->integer('object_id');
            $table->boolean('is_default');
            $table->string('picture_name');
            $table->string('physical_name');
            $table->integer('created_by')->nullable();
            $table->integer('updated_by')->nullable();
            $table->integer('deleted_by')->nullable();
            $table->timestampsTz();
            $table->index('object_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('pictures', function (Blueprint $table) {
            $table->dropIndex('object_id');
        });
        Schema::dropIfExists('pictures');
    }
}
