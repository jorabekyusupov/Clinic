<?php

namespace Database\Factories;

use App\Models\Master\Organization\OrganizationTranslation;
use Illuminate\Database\Eloquent\Factories\Factory;

class OrganizationTranslationFactory extends Factory
{
    protected $model = OrganizationTranslation::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->company,
            'address' => $this->faker->address
        ];
    }
}
