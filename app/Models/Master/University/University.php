<?php

namespace App\Models\Master\University;

use App\Traits\NewHasFactory;
use Database\Factories\UniversityFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class University extends Model
{
    use NewHasFactory;

    protected static string $factoryModel = UniversityFactory::class;

    use SoftDeletes;

    protected $fillable = ['created_by', 'updated_by', 'deleted_by'];

    public function translations()
    {
        return $this->hasMany(UniversityTranslation::class);
    }

    public function translation()
    {
        return $this->hasOne(UniversityTranslation::class);
    }
}
