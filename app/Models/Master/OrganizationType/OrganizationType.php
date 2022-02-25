<?php

namespace App\Models\Master\OrganizationType;

use App\Traits\NewHasFactory;
use Database\Factories\OrganizationTypeFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class OrganizationType extends Model
{
    use SoftDeletes;
    use NewHasFactory;

    protected static string $factoryModel = OrganizationTypeFactory::class;

    protected $fillable = ['created_by'];
    public function translations()
    {
        return $this->hasMany(OrganizationTypeTranslation::class, 'organization_type_id', 'id');
    }

    public function translation()
    {
        return $this->hasOne(OrganizationTypeTranslation::class, 'organization_type_id', 'id');
    }
}
