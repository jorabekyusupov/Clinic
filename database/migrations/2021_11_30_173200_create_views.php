<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class CreateViews extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement(file_get_contents('database/views/categories_view_create.sql'));
        DB::statement(file_get_contents('database/views/content_words_view_create.sql'));
        DB::statement(file_get_contents('database/views/organization_types_view_create.sql'));
        DB::statement(file_get_contents('database/views/organizations_view_create.sql'));
        DB::statement(file_get_contents('database/views/service_classes_view_create.sql'));
        DB::statement(file_get_contents('database/views/service_sections_view_create.sql'));
        DB::statement(file_get_contents('database/views/service_subsections_view_create.sql'));
        DB::statement(file_get_contents('database/views/services_view_create.sql'));
        DB::statement(file_get_contents('database/views/specialties_view_create.sql'));
        DB::statement(file_get_contents('database/views/specialty_types_view_create.sql'));
        DB::statement(file_get_contents('database/views/permissions_view_create.sql'));
        DB::statement(file_get_contents('database/views/roles_view_create.sql'));
        DB::statement(file_get_contents('database/views/weekly_schedules_view_create.sql'));
        DB::statement(file_get_contents('database/views/universities_view_create.sql'));
        DB::statement(file_get_contents('database/views/study_degrees_view_create.sql'));
        DB::statement(file_get_contents('database/views/study_types_view_create.sql'));
        DB::statement(file_get_contents('database/views/organization_equipment_view_create.sql'));
        DB::statement(file_get_contents('database/views/doctors_view_create.sql'));
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement(file_get_contents('database/views/categories_view_drop.sql'));
        DB::statement(file_get_contents('database/views/content_words_view_drop.sql'));
        DB::statement(file_get_contents('database/views/organization_types_view_drop.sql'));
        DB::statement(file_get_contents('database/views/organizations_view_drop.sql'));
        DB::statement(file_get_contents('database/views/service_classes_view_drop.sql'));
        DB::statement(file_get_contents('database/views/service_sections_view_drop.sql'));
        DB::statement(file_get_contents('database/views/service_subsections_view_drop.sql'));
        DB::statement(file_get_contents('database/views/services_view_drop.sql'));
        DB::statement(file_get_contents('database/views/specialties_view_drop.sql'));
        DB::statement(file_get_contents('database/views/specialty_types_view_drop.sql'));
        DB::statement(file_get_contents('database/views/permissions_view_drop.sql'));
        DB::statement(file_get_contents('database/views/roles_view_drop.sql'));
        DB::statement(file_get_contents('database/views/universities_view_drop.sql'));
        DB::statement(file_get_contents('database/views/study_degrees_view_drop.sql'));
        DB::statement(file_get_contents('database/views/study_types_view_drop.sql'));
        DB::statement(file_get_contents('database/views/organization_equipment_view_drop.sql'));
        DB::statement(file_get_contents('database/views/doctors_view_drop.sql'));
    }
}
