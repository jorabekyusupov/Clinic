<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateServiceClassTranslationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('service_class_translations', function (Blueprint $table) {
            $table->integer('id', true);
            $table->integer('service_class_id');
            $table->string('language_code', 10);
            $table->string('name')->nullable();
            $table->index('service_class_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('service_class_translations', function (Blueprint $table) {
            $table->dropIndex('service_class_id');
        });
        Schema::dropIfExists('service_class_translations');
    }
}
