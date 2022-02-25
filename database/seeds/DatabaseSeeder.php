<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(LanguageSeeder::class);
        $this->call(RolePermissionSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(CategorySeeder::class);
        $this->call(ContentWordSeeder::class);
        $this->call(OrganizationTypeSeeder::class);
        $this->call(SpecialityTypeSeeder::class);
        $this->call(SpecialistSeeder::class);
        $this->call(WeeklyScheduleSeeder::class);
        $this->call(ServiceSeeder::class);
        $this->call(StudyTypeSeeder::class);
        $this->call(StudyDegreeSeeder::class);
        $this->call(OauthClientSeeder::class);
        $this->call(FakeDatabaseSeeder::class);
    }
}
