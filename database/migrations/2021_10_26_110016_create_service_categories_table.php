<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateServiceCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('service_categories', function (Blueprint $table) {
            $table->integer('service_id');
            $table->integer('category_id');
            $table->unique(["service_id", "category_id"], 'service_category_unique');
            $table->index('service_id', 'category_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('service_categories', function (Blueprint $table) {
             $table->dropUnique('service_category_unique');
             $table->dropIndex('service_id', 'category_id');
            });
        Schema::dropIfExists('service_categories');
    }
}
