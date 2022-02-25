<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePermissionTranslationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('permission_translations', function (Blueprint $table) {
            $table->integer('id', true);
            $table->integer('permission_id');
            $table->string('language_code', 100);
            $table->string('display_name')->nullable();
            $table->string('description')->nullable();
            $table->index('permission_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('permission_translations', function (Blueprint $table) {
            $table->dropIndex('permission_id');
        });
        Schema::dropIfExists('permission_translations');
    }
}
