<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SpecialityTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::unprepared(file_get_contents('database/seeds/sql/specialty_types.sql'));
        DB::unprepared(file_get_contents('database/seeds/sql/specialty_type_translations.sql'));
    }
}
