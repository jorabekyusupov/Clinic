<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StudyDegreeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::unprepared(file_get_contents('database/seeds/sql/study_degrees.sql'));
        DB::unprepared(file_get_contents('database/seeds/sql/study_degree_translations.sql'));
    }
}
