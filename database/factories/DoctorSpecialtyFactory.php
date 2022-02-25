<?php

namespace Database\Factories;

use App\Models\Master\Doctor\Doctor;
use App\Models\Master\DoctorSpecialty\DoctorSpecialty;
use App\Models\Master\Specialty\Specialty;
use Illuminate\Database\Eloquent\Factories\Factory;

class DoctorSpecialtyFactory extends Factory
{
    protected $model = DoctorSpecialty::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'doctor_id' => Doctor::all()->random()->id,
            'specialty_id' => Specialty::all()->random()->id,
            'created_at' => now(),
            'updated_at' => now(),
            'updated_by' => 1,
            'created_by' => 1
        ];
    }
}
