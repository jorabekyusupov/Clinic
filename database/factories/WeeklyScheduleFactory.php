<?php

namespace Database\Factories;

use App\Models\Master\WeeklySchedule\WeeklySchedule;
use Illuminate\Database\Eloquent\Factories\Factory;

class WeeklyScheduleFactory extends Factory
{
    protected $model = WeeklySchedule::class;
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'code' => $this->faker->randomElement(['A','B','C','D']),
            'created_at' => now(),
            'updated_at' => now(),
            'updated_by' => 1,
            'created_by' => 1
        ];
    }
}
