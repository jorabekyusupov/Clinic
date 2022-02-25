<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StudyTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::unprepared(file_get_contents('database/seeds/sql/study_types.sql'));
        DB::unprepared(file_get_contents('database/seeds/sql/study_type_translations.sql'));
    }
}
