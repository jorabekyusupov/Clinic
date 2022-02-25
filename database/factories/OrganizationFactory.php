<?php

namespace Database\Factories;

use App\Models\Master\Organization\Organization;
use App\Models\Master\OrganizationType\OrganizationType;
use App\Models\Master\WeeklySchedule\WeeklySchedule;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class OrganizationFactory extends Factory
{
    protected $model = Organization::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'organization_type_id' => OrganizationType::all()->random()->id,
            'weekly_schedule_id' => WeeklySchedule::all()->random()->id,
            'database_name' => env('DB_PREFIX', 'med') . '_' . Str::random(8),
            'created_by' => 1,
            'created_at' => now(),
            'updated_at' => now(),
            'updated_by' => 1
        ];
    }
}
