<?php

namespace Database\Factories;

use App\Models\Master\Organization\Organization;
use App\Models\Master\OrganizationEquipment\OrganizationEquipment;
use Illuminate\Database\Eloquent\Factories\Factory;

class OrganizationEquipmentFactory extends Factory
{
    protected $model = OrganizationEquipment::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'organization_id' => Organization::all()->random()->id,
            'created_at' => now(),
            'updated_at' => now(),
            'updated_by' => 1,
            'created_by' => 1
        ];
    }
}
