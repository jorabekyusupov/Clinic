<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::unprepared(file_get_contents('database/seeds/sql/services.sql'));
        DB::unprepared(file_get_contents('database/seeds/sql/service_translations.sql'));
        DB::unprepared(file_get_contents('database/seeds/sql/service_categories.sql'));
    }
}
