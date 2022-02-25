<?php

namespace App\Models\Master\OrganizationEquipment;

use App\Models\Master\Language\Language;
use App\Traits\NewHasFactory;
use Database\Factories\OrganizationEquipmentTranslationFactory;
use Illuminate\Database\Eloquent\Model;

class OrganizationEquipmentTranslation extends Model
{
    use NewHasFactory;

    protected static string $factoryModel = OrganizationEquipmentTranslationFactory::class;

    public $timestamps = false;

    protected $fillable = ['organization_equipment_id', 'language_code', 'name'];

    public function language()
    {
        return $this->hasOne(Language::class, 'code', 'language_code');
    }
}
