<?php

namespace Database\Factories;

use App\Models\Master\StudyDegree\StudyDegreeTranslation;
use Illuminate\Database\Eloquent\Factories\Factory;

class StudyDegreeTranslationFactory extends Factory
{
    protected $model = StudyDegreeTranslation::class;
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
