<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrganizationTypeTranslationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('organization_type_translations', function (Blueprint $table) {
            $table->integer('id', true);
            $table->integer('organization_type_id');
            $table->string('language_code', 10);
            $table->string('name', 100);
            $table->string('description')->nullable();
            $table->index('organization_type_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('organization_type_translations', function (Blueprint $table) {
            $table->dropIndex('organization_type_id');
        });
        Schema::dropIfExists('organization_type_translations');
    }
}
