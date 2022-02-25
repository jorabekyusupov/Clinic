<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContactsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contacts', function (Blueprint $table) {
            $table->id();
            $table->string('object_type', 100)->comment('DOCTOR, ORGANIZATION, PATIENT, USER');
            $table->string('contact_type', 100)->comment('EMAIL, PHONE, SOCIALPAGES, WEBSITE');
            $table->integer('object_id');
            $table->string('value')->nullable();
            $table->integer('created_by')->nullable();
            $table->integer('updated_by')->nullable();
            $table->timestampsTz();
            $table->index('object_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('contacts', function (Blueprint $table) {
            $table->dropIndex('object_id');
        });
        Schema::dropIfExists('contacts');
    }
}
