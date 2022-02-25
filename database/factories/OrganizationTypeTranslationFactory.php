<?php

namespace Database\Factories;

use App\Models\Master\OrganizationType\OrganizationTypeTranslation;
use Illuminate\Database\Eloquent\Factories\Factory;

class OrganizationTypeTranslationFactory extends Factory
{
    protected $model = OrganizationTypeTranslation::class;
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->word,
            'description' => $this->faker->sentence
        ];
    }
}
