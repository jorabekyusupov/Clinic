<?php

namespace Database\Factories;

use App\Models\Master\ContentWord\ContentWordTranslation;
use Illuminate\Database\Eloquent\Factories\Factory;

class ContentWordTranslationFactory extends Factory
{
    protected $model = ContentWordTranslation::class;
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'translation' => $this->faker->word,
        ];
    }
}
