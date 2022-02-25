<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUniversityTranslationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('university_translations', function (Blueprint $table) {
            $table->integer('id', true);
            $table->integer('university_id');
            $table->string('language_code', 10);
            $table->string('name')->nullable();
            $table->index('university_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('university_translations', function (Blueprint $table) {
            $table->dropIndex('university_id');
        });
        Schema::dropIfExists('university_translations');
    }
}
