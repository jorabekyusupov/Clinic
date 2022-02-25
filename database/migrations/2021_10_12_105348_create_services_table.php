<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateServicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('services', function (Blueprint $table) {
            $table->integer('id', true);
            $table->string('code', 20)->nullable();
            $table->integer('category_id')->nullable();
            $table->integer('service_class_id')->nullable();
            $table->integer('service_section_id')->nullable();
            $table->integer('service_subsection_id')->nullable();
            $table->integer('created_by')->nullable();
            $table->integer('updated_by')->nullable();
            $table->integer('deleted_by')->nullable();
            $table->timestampsTz();
            $table->softDeletes();
            $table->index('category_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('services', function (Blueprint $table) {
            $table->dropIndex('service_class_id', 'service_section_id', 'service_subsection_id');
        });
        Schema::dropIfExists('services');
    }
}
