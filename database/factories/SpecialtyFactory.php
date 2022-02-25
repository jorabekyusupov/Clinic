<?php

namespace Database\Factories;

use App\Models\Master\Specialty\Specialty;
use App\Models\Master\SpecialtyType\SpecialtyType;
use Illuminate\Database\Eloquent\Factories\Factory;

class SpecialtyFactory extends Factory
{
    protected $model = Specialty::class;
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'specialty_type_id' => SpecialtyType::all()->random()->id,
            'created_at' => now(),
            'updated_at' => now(),
            'updated_by' => 1,
            'created_by' => 1
        ];
    }
}
