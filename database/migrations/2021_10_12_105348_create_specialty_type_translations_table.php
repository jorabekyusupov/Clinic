<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSpecialtyTypeTranslationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('specialty_type_translations', function (Blueprint $table) {
            $table->integer('id', true);
            $table->integer('specialty_type_id');
            $table->string('language_code', 10);
            $table->string('name')->nullable();
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
        Schema::table('specialty_type_translations', function (Blueprint $table) {
            $table->dropIndex('specialty_type_id');
        });
        Schema::dropIfExists('specialty_type_translations');
    }
}
