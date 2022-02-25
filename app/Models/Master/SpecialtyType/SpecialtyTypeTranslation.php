<?php

namespace App\Models\Master\SpecialtyType;

use App\Models\Master\Language\Language;
use App\Traits\NewHasFactory;
use Database\Factories\SpecialtyTypeTranslationFactory;
use Illuminate\Database\Eloquent\Model;

class SpecialtyTypeTranslation extends Model
{
    use NewHasFactory;

    protected static string $factoryModel = SpecialtyTypeTranslationFactory::class;


    protected $fillable = ['specialty_type_id','language_code','name'];
    public $timestamps = false;

    public function language(){
        return $this->hasOne(Language::class, 'code', 'language_code');
    }
}
