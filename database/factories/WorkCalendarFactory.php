<?php

namespace Database\Factories;

use App\Models\Master\WorkCalendar\WorkCalendar;
use Illuminate\Database\Eloquent\Factories\Factory;

class WorkCalendarFactory extends Factory
{
    protected $model = WorkCalendar::class;
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'calendar_date' => $this->faker->unique()->date(),
            'work_day_sequence' => $this->faker->randomElement([1,2,3,4,5,6,7,8,9,10]),
            'is_work_day' => $this->faker->boolean(),
            'is_weekend' => $this->faker->boolean(),
            'is_holiday' => $this->faker->boolean(),
            'holiday_name' => $this->faker->word(),
        ];
    }
}
