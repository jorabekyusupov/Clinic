<?php

namespace Database\Factories;

use App\Models\Master\WeeklySchedule\WeeklyScheduleTranslation;
use Illuminate\Database\Eloquent\Factories\Factory;

class WeeklyScheduleTranslationFactory extends Factory
{
    protected $model = WeeklyScheduleTranslation::class;
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
