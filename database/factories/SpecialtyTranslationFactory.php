<?php

namespace Database\Factories;

use App\Models\Master\Specialty\SpecialtyTranslation;
use Illuminate\Database\Eloquent\Factories\Factory;

class SpecialtyTranslationFactory extends Factory
{
    protected $model = SpecialtyTranslation::class;
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
