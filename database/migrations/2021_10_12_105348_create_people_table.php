<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePeopleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('people', function (Blueprint $table) {
            $table->integer('id', true);
            $table->string('first_name', 100);
            $table->string('last_name', 100)->nullable();
            $table->string('middle_name', 100)->nullable();
            $table->date('born_date')->nullable();
            $table->string('jshshir', 14)->nullable();
            $table->char('gender', 1)->comment('M-male, F-female');
            $table->timestampTz('created_at')->nullable();
            $table->integer('created_by')->nullable();
            $table->timestampTz('updated_at')->nullable();
            $table->integer('updated_by')->nullable();
            $table->softDeletes();
            $table->integer('deleted_by')->nullable();
            $table->index('jshshir');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('people', function (Blueprint $table) {
            $table->dropIndex('jshshir');
        });
        Schema::dropIfExists('people');
    }
}
