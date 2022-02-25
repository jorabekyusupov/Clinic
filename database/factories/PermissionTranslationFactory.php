<?php

namespace Database\Factories;

use App\Models\Master\Permission\PermissionTranslation;
use Illuminate\Database\Eloquent\Factories\Factory;

class PermissionTranslationFactory extends Factory
{
    protected $model = PermissionTranslation::class;
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
