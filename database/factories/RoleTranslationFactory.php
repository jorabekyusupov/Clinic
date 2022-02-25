<?php

namespace Database\Factories;

use App\Models\Master\Role\RoleTranslation;
use Illuminate\Database\Eloquent\Factories\Factory;

class RoleTranslationFactory extends Factory
{
    protected $model = RoleTranslation::class;
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'display_name' => $this->faker->word,
            'description' => $this->faker->sentence
        ];
    }
}
