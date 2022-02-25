<?php

namespace Database\Factories;

use App\Models\Master\Doctor\Doctor;
use App\Models\Master\Organization\Organization;
use App\Models\Master\OrganizationDoctor\OrganizationDoctor;
use Illuminate\Database\Eloquent\Factories\Factory;

class OrganizationDoctorFactory extends Factory
{
    protected $model = OrganizationDoctor::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'organization_id' => Organization::all()->random()->id,
            'doctor_id' => Doctor::all()->random()->id,
            'created_by' => 1,
            'created_at' => now(),
            'updated_at' => now(),
            'updated_by' => 1,
        ];
    }
}
