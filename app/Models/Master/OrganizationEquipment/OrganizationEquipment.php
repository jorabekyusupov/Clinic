<?php

namespace App\Models\Master\OrganizationEquipment;

use App\Traits\NewHasFactory;
use Database\Factories\OrganizationEquipmentFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class OrganizationEquipment extends Model
{
    use SoftDeletes;
    use NewHasFactory;


    protected static string $factoryModel = OrganizationEquipmentFactory::class;


    public $fillable = ['organization_id', 'created_by', 'updated_by', 'deleted_by'];

    public function translations()
    {
        return $this->hasMany(OrganizationEquipmentTranslation::class, 'organization_equipment_id', 'id');
    }

    public function translation()
    {
        return $this->hasOne(OrganizationEquipmentTranslation::class, 'organization_equipment_id', 'id');
    }
}
