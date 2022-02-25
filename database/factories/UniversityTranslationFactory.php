<?php

namespace Database\Factories;

use App\Models\Master\University\UniversityTranslation;
use Illuminate\Database\Eloquent\Factories\Factory;

class UniversityTranslationFactory extends Factory
{
    protected $model = UniversityTranslation::class;
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
