<?php

namespace App\Models\Master\StudyType;

use App\Models\Master\Language\Language;
use App\Traits\NewHasFactory;
use Database\Factories\StudyTypeTranslationFactory;
use Illuminate\Database\Eloquent\Model;

class StudyTypeTranslation extends Model
{
    use NewHasFactory;

    protected static string $factoryModel = StudyTypeTranslationFactory::class;


    public $timestamps = false;

    protected $fillable = ['name', 'language_code', 'study_type_id'];

    public function language()
    {
        return $this->hasOne(Language::class, 'code', 'language_code');
    }
}
