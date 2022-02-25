<?php

namespace Database\Factories;

use App\Models\Master\Organization\Organization;
use App\Models\Master\OrganizationService\OrganizationService;
use App\Models\Master\Service\Service;
use Illuminate\Database\Eloquent\Factories\Factory;

class OrganizationServiceFactory extends Factory
{
    protected $model = OrganizationService::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'organization_id' => Organization::all()->random()->id,
            'service_id' => Service::all()->random()->id,
            'price' => $this->faker->randomFloat(null, 10, 100),
            'created_by' => 1,
            'created_at' => now(),
            'updated_at' => now(),
            'updated_by' => 1,
        ];
    }
}
