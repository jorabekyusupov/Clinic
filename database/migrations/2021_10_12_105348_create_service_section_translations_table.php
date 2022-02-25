<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateServiceSectionTranslationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('service_section_translations', function (Blueprint $table) {
            $table->integer('id', true);
            $table->integer('service_section_id');
            $table->string('language_code', 10);
            $table->string('name')->nullable();
            $table->index('service_section_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('service_section_translations', function (Blueprint $table) {
            $table->dropIndex('service_section_id');
        });
        Schema::dropIfExists('service_section_translations');
    }
}
