<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudyTypeTranslationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('study_type_translations', function (Blueprint $table) {
            $table->integer('id', true);
            $table->integer('study_type_id');
            $table->string('language_code', 10);
            $table->string('name')->nullable();
            $table->index('study_type_id');
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
            $table->dropIndex('study_type_id');
        });
        Schema::dropIfExists('study_type_translations');
    }
}
