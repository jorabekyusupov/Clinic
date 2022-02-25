<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContentWordTranslationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('content_word_translations', function (Blueprint $table) {
            $table->integer('id', true);
            $table->integer('content_word_id');
            $table->string('language_code', 15);
            $table->string('translation')->nullable();
            $table->index('content_word_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('content_word_translations', function (Blueprint $table) {
            $table->dropIndex('content_word_id');
        });
        Schema::dropIfExists('content_word_translations');
    }
}
