<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRoleTranslationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('role_translations', function (Blueprint $table) {
            $table->integer('id', true);
            $table->integer('role_id');
            $table->string('language_code', 100);
            $table->string('display_name')->nullable();
            $table->string('description')->nullable();
            $table->index('role_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('role_translations', function (Blueprint $table) {
            $table->dropIndex('role_id');
        });
        Schema::dropIfExists('role_translations');
    }
}
