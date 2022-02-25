<?php

namespace Database\Factories;

use App\Models\Master\Doctor\Doctor;
use App\Models\Master\DoctorStudy\DoctorStudy;
use App\Models\Master\Specialty\Specialty;
use App\Models\Master\StudyDegree\StudyDegree;
use App\Models\Master\StudyType\StudyType;
use App\Models\Master\University\University;
use Illuminate\Database\Eloquent\Factories\Factory;

class DoctorStudyFactory extends Factory
{
    protected $model = DoctorStudy::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'doctor_id' => Doctor::all()->random()->id,
            'study_type_id' => StudyType::all()->random()->id,
            'university_id' => University::all()->random()->id,
            'study_degree_id' => StudyDegree::all()->random()->id,
            'specialty_id' => Specialty::all()->random()->id,
            'direction' => $this->faker->word(),
            'description' => $this->faker->word(),
            'began_year' => $this->faker->date('Y'),
            'graduated_year' => $this->faker->date('Y'),
            'created_at' => now(),
            'updated_at' => now(),
            'updated_by' => 1,
            'created_by' => 1
        ];
    }
}
