<?php

namespace App\Models\Master\StudyType;

use App\Traits\NewHasFactory;
use Database\Factories\StudyTypeFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class StudyType extends Model
{
    use NewHasFactory;

    protected static string $factoryModel = StudyTypeFactory::class;


    use SoftDeletes;
    protected $fillable = ['created_by', 'updated_by', 'deleted_by'];

    public function translations()
    {
        return $this->hasMany(StudyTypeTranslation::class);
    }

    public function translation()
    {
        return $this->hasOne(StudyTypeTranslation::class);
    }
}
