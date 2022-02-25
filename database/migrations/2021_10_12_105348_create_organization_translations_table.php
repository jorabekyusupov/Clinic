<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrganizationTranslationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('organization_translations', function (Blueprint $table) {
            $table->integer('id', true);
            $table->integer('organization_id');
            $table->string('language_code', 100);
            $table->string('name');
            $table->string('address')->nullable();
            $table->index('organization_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('organization_translations', function (Blueprint $table) {
            $table->dropIndex('organization_id');
        });
        Schema::dropIfExists('organization_translations');
    }
}
