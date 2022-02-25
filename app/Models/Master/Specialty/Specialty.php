<?php

namespace App\Models\Master\Specialty;

use App\Models\Master\SpecialtyType\SpecialtyType;
use App\Traits\NewHasFactory;
use Database\Factories\SpecialtyFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Specialty extends Model
{
    use SoftDeletes;
    use NewHasFactory;
    protected static string $factoryModel = SpecialtyFactory::class;


    protected $fillable = ['specialty_type_id', 'created_by', 'deleted_by', 'updated_by'];

    public function translations()
    {
        return $this->hasMany(SpecialtyTranslation::class, 'specialty_id', 'id');
    }

    public function translation()
    {
        return $this->hasOne(SpecialtyTranslation::class, 'specialty_id', 'id');
    }

    public function specialtyType()
    {
        return $this->hasOne(SpecialtyType::class, 'id', 'specialty_type_id');
    }
}
