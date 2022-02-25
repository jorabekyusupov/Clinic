<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrganizationServicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('organization_services', function (Blueprint $table) {
            $table->integer('id', true);
            $table->integer('organization_id');
            $table->integer('service_id');
            $table->float('price')->default(0);
            $table->timestampTz('created_at')->nullable();
            $table->integer('created_by')->nullable();
            $table->timestampTz('updated_at')->nullable();
            $table->integer('updated_by')->nullable();
            $table->softDeletes();
            $table->integer('deleted_by')->nullable();

            $table->unique(["service_id", "organization_id"], 'organization_service_service_id_organization_id_unique');
            $table->index('organization_id', 'service_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('organization_services', function (Blueprint $table) {
            $table->dropUnique('organization_service_service_id_organization_id_unique');
            $table->dropIndex('organization_id', 'service_id');
        });
        Schema::dropIfExists('organization_services');
    }
}
