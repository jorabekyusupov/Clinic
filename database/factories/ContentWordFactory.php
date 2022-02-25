<?php

namespace Database\Factories;

use App\Models\Master\ContentWord\ContentWord;
use Illuminate\Database\Eloquent\Factories\Factory;

class ContentWordFactory extends Factory
{
    protected $model = ContentWord::class;
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'word' => $this->faker->unique()->word(),
            'status' => $this->faker->randomElement([0,1]),
            'created_at' => now(),
            'updated_at' => now(),
            'updated_by' => 1,
            'created_by' => 1
        ];
    }
}
