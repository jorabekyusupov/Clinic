<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSpecialtyTranslationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('specialty_translations', function (Blueprint $table) {
            $table->integer('id', true);
            $table->integer('specialty_id');
            $table->string('language_code', 10);
            $table->string('name', 100)->nullable();
            $table->index('specialty_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('specialty_translations', function (Blueprint $table) {
            $table->dropIndex('specialty_id');
        });
        Schema::dropIfExists('specialty_translations');
    }
}
