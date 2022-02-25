<?php

namespace App\Models\Master\StudyDegree;

use App\Models\Master\Language\Language;
use App\Traits\NewHasFactory;
use Database\Factories\StudyDegreeTranslationFactory;
use Illuminate\Database\Eloquent\Model;

class StudyDegreeTranslation extends Model
{
    use NewHasFactory;
    protected static string $factoryModel = StudyDegreeTranslationFactory::class;


    public $timestamps = false;

    protected $fillable = ['name', 'language_code', 'study_degree_id'];

    public function language()
    {
        return $this->hasOne(Language::class, 'code', 'language_code');
    }
}
