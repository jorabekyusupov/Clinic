<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ContentWordSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::unprepared(file_get_contents('database/seeds/sql/content_words.sql'));
        DB::unprepared(file_get_contents('database/seeds/sql/content_word_translations.sql'));
    }
}
