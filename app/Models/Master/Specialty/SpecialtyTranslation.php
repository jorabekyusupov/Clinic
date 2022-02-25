<?php

namespace App\Models\Master\Specialty;

use App\Models\Master\Language\Language;
use App\Traits\NewHasFactory;
use Database\Factories\SpecialtyTranslationFactory;
use Illuminate\Database\Eloquent\Model;

class SpecialtyTranslation extends Model
{
    use NewHasFactory;

    protected static string $factoryModel = SpecialtyTranslationFactory::class;


    protected $fillable = ['specialty_id','language_code','name'];
    public $timestamps = false;

    public function language(){
        return $this->hasOne(Language::class, 'code', 'language_code');
    }
}
