<?php

namespace Database\Factories;

use App\Models\Master\Language\Language;
use Illuminate\Database\Eloquent\Factories\Factory;

class LanguageFactory extends Factory
{
    protected $model = Language::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'code' => substr($this->faker->word(), 0, 2),
            'name' => $this->faker->word,
            'is_active' => $this->faker->randomElement([0,1]),
            'created_by' => 1,
            'created_at' => now(),
            'updated_at' => now(),
            'updated_by' => 1,
        ];
    }
}
