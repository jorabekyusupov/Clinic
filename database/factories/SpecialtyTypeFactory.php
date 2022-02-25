<?php

namespace Database\Factories;

use App\Models\Master\SpecialtyType\SpecialtyType;
use Illuminate\Database\Eloquent\Factories\Factory;

class SpecialtyTypeFactory extends Factory
{
    protected $model = SpecialtyType::class;
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'type' => $this->faker->randomElement([0,1]),
            'created_at' => now(),
            'updated_at' => now(),
            'updated_by' => 1,
            'created_by' => 1
        ];
    }
}
