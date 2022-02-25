<?php

namespace Database\Factories;

use App\Models\Master\StudyType\StudyTypeTranslation;
use Illuminate\Database\Eloquent\Factories\Factory;

class StudyTypeTranslationFactory extends Factory
{
    protected $model = StudyTypeTranslation::class;
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
