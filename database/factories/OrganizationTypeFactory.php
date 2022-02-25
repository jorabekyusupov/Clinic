<?php

namespace Database\Factories;

use App\Models\Master\OrganizationType\OrganizationType;
use Illuminate\Database\Eloquent\Factories\Factory;

class OrganizationTypeFactory extends Factory
{
    protected $model = OrganizationType::class;
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'created_by' => 1,
            'created_at' => now(),
            'updated_at' => now(),
            'updated_by' => 1,
        ];
    }
}
