<?php

namespace Database\Factories;

use App\Models\Master\SpecialtyType\SpecialtyTypeTranslation;
use Illuminate\Database\Eloquent\Factories\Factory;

class SpecialtyTypeTranslationFactory extends Factory
{
    protected $model = SpecialtyTypeTranslation::class;
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->word,
        ];
    }
}
