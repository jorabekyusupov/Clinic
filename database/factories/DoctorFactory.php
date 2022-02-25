<?php

namespace Database\Factories;

use App\Models\Master\Doctor\Doctor;
use App\Models\Master\Person\Person;
use Illuminate\Database\Eloquent\Factories\Factory;

class DoctorFactory extends Factory
{
    protected $model = Doctor::class;
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'person_id' =>$this->faker->unique()->randomElement(Person::all()->pluck('id')),
            'status' => $this->faker->randomElement([0,1]),
            'created_by' => 1,
            'created_at' => now(),
            'updated_at' => now(),
            'updated_by' => 1,
        ];
    }
}
