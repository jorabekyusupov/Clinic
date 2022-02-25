<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrganizationEquipmentTranslationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('organization_equipment_translations', function (Blueprint $table) {
            $table->integer('id', true);
            $table->integer('organization_equipment_id');
            $table->string('language_code', 10);
            $table->string('name')->nullable();
            $table->index('organization_equipment_id');
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
            $table->dropIndex('organization_equipment_id');
        });
        Schema::dropIfExists('organization_equipment_translations');
    }
}
