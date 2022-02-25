<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSpecialtyTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('specialty_types', function (Blueprint $table) {
            $table->integer('id', true);
            $table->integer('created_by')->nullable();
            $table->timestampTz('created_at')->nullable();
            $table->integer('updated_by')->nullable();
            $table->timestampTz('updated_at')->nullable();
            $table->integer('deleted_by')->nullable();
            $table->softDeletes();
            $table->smallInteger('type')->nullable()->default(0)->comment('0-Виды основных медицинских специальностей, 1-Узкие специалисты');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('specialty_types');
    }
}
