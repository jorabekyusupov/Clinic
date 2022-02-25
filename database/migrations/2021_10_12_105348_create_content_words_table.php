<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContentWordsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('content_words', function (Blueprint $table) {
            $table->integer('id', true);
            $table->string('word', 100)->unique('content_words_word_key');
            $table->smallInteger('status')->comment('0 - inactive, 1 - active');
            $table->integer('created_by')->nullable();
            $table->timestampTz('created_at')->nullable();
            $table->softDeletes();
            $table->integer('deleted_by')->nullable();
            $table->timestampTz('updated_at')->nullable();
            $table->integer('updated_by')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('content_words');
    }
}
