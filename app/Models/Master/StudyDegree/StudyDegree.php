<?php

namespace App\Models\Master\StudyDegree;

use App\Traits\NewHasFactory;
use Database\Factories\StudyDegreeFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class StudyDegree extends Model
{
    use SoftDeletes;
    use NewHasFactory;

    protected static string $factoryModel = StudyDegreeFactory::class;



    protected $fillable = ['created_by', 'updated_by', 'deleted_by'];

    public function translations()
    {
        return $this->hasMany(StudyDegreeTranslation::class);
    }

    public function translation()
    {
        return $this->hasOne(StudyDegreeTranslation::class);
    }
}
