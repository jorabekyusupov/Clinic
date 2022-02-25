<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateServiceSubsectionTranslationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('service_subsection_translations', function (Blueprint $table) {
            $table->integer('id', true);
            $table->integer('service_subsection_id');
            $table->string('language_code', 5);
            $table->string('name')->nullable();
            $table->index('service_subsection_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('service_subsection_translations', function (Blueprint $table) {
            $table->dropIndex('service_subsection_id');
        });
        Schema::dropIfExists('service_subsection_translations');
    }
}
