<?php

use App\Models\Master\Organization\Organization;
use App\Models\Master\OrganizationDoctor\OrganizationDoctor;
use App\Models\Master\OrganizationService\OrganizationService;
use App\Models\Master\Organization\OrganizationTranslation;
use App\Models\Master\Person\Person;
use Illuminate\Database\Seeder;

class FakeDatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {

        // people
        Person::factory()->count(50)->create()->each(function ($person) {

            // doctor
           \App\Models\Master\Doctor\Doctor::factory()->create(['person_id' => $person->id]);

        });

        $this->command->info(50 . ' doctors created successfully.');

        // organizaions
        Organization::factory(50)->create()->each(function ($organization) {

            // translations
            OrganizationTranslation::factory()->create(['organization_id' => $organization->id, 'language_code' => 'uz']);
            OrganizationTranslation::factory()->create(['organization_id' => $organization->id, 'language_code' => 'uzc']);
            OrganizationTranslation::factory()->create(['organization_id' => $organization->id, 'language_code' => 'ru']);

            // bind servrices
            OrganizationService::factory(1)->create(['organization_id' => $organization->id]);

            // bind doctors
            OrganizationDoctor::factory(1)->create(['organization_id' => $organization->id]);

        });

        $this->command->info(50 . ' organizations created successfully.');
        $this->command->info(1 . ' service binded to each organization.');
        $this->command->info(1 . ' doctor binded to each organization.');
    }
}
