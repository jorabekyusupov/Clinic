<?php

namespace App\Models\Master\University;

use App\Models\Master\Language\Language;
use App\Traits\NewHasFactory;
use Database\Factories\UniversityTranslationFactory;
use Illuminate\Database\Eloquent\Model;

class UniversityTranslation extends Model
{
    use NewHasFactory;

    protected static string $factoryModel = UniversityTranslationFactory::class;

    public $timestamps = false;

    protected $fillable = ['name', 'language_code', 'university_id'];

    public function language()
    {
        return $this->hasOne(Language::class, 'code', 'language_code');
    }
}
