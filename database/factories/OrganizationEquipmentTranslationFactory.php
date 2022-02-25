<?php

namespace Database\Factories;

use App\Models\Master\OrganizationEquipment\OrganizationEquipmentTranslation;
use Illuminate\Database\Eloquent\Factories\Factory;

class OrganizationEquipmentTranslationFactory extends Factory
{
    protected $model = OrganizationEquipmentTranslation::class;
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
