<?php

namespace Database\Factories;

use App\Models\Master\Contact\Contact;
use Illuminate\Database\Eloquent\Factories\Factory;

class ContactFactory extends Factory
{
    protected $model = Contact::class;
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'object_type' => $this->faker->randomElement(['doctor','organization','patient','user']),
            'contact_type' => $this->faker->randomElement(['email','phone','website']),
            'object_id' => 1,
            'value' => $this->faker->word(),
            'created_by' => 1,
            'created_at' => now(),
            'updated_at' => now(),
            'updated_by' => 1,
        ];
    }
}
