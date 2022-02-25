<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::unprepared(file_get_contents('database/seeds/sql/roles.sql'));
        DB::unprepared(file_get_contents('database/seeds/sql/role_translations.sql'));
     
        DB::unprepared(file_get_contents('database/seeds/sql/permissions.sql'));
        DB::unprepared(file_get_contents('database/seeds/sql/permission_translations.sql'));
     
        DB::unprepared(file_get_contents('database/seeds/sql/permission_role.sql'));
    }
}
