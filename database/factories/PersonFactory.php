<?php

namespace Database\Factories;

use App\Models\Master\Person\Person;
use Illuminate\Database\Eloquent\Factories\Factory;

class PersonFactory extends Factory
{
    protected $model = Person::class;
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'first_name' => $this->faker->firstName,
            'last_name' => $this->faker->lastName,
            'middle_name' => $this->faker->lastName,
            'born_date' => $this->faker->date,
            'jshshir' => $this->faker->randomNumber(7) . $this->faker->randomNumber(7),
            'gender' => $this->faker->randomElement(['M','F']),
            'created_at' => now(),
            'updated_at' => now(),
            'updated_by' => 1,
            'created_by' => 1
        ];
    }
}
