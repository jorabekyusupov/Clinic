<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudyDegreeTranslationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('study_degree_translations', function (Blueprint $table) {
            $table->integer('id', true);
            $table->integer('study_degree_id');
            $table->string('language_code', 10);
            $table->string('name')->nullable();
            $table->index('study_degree_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('study_degree_translations', function (Blueprint $table) {
            $table->dropIndex('study_degree_id');
        });
        Schema::dropIfExists('study_degree_translations');
    }
}
