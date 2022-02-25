<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SpecialistSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::unprepared(file_get_contents('database/seeds/sql/specialties.sql'));
        DB::unprepared(file_get_contents('database/seeds/sql/specialty_translations.sql'));
    }
}
