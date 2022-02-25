<?php

namespace App\Models\Master\SpecialtyType;

use App\Traits\NewHasFactory;
use Database\Factories\SpecialtyTypeFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SpecialtyType extends Model
{
    use SoftDeletes;
    use NewHasFactory;
    protected static string $factoryModel = SpecialtyTypeFactory::class;

    protected $fillable = ['type', 'created_by', 'updated_by', 'deleted_by'];

    public function translations()
    {
        return $this->hasMany(SpecialtyTypeTranslation::class, 'specialty_type_id', 'id');
    }

    public function translation()
    {
        return $this->hasOne(SpecialtyTypeTranslation::class, 'specialty_type_id', 'id');
    }
}
