<?php

namespace Database\Factories;

use App\Models\Master\StudyType\StudyType;
use Illuminate\Database\Eloquent\Factories\Factory;

class StudyTypeFactory extends Factory
{
    protected $model = StudyType::class;
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'created_at' => now(),
            'updated_at' => now(),
            'updated_by' => 1,
            'created_by' => 1
        ];
    }
}
