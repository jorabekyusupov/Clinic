<?php

namespace App\Models\Master\Service;

use App\Models\Master\Language\Language;
use App\Traits\NewHasFactory;
use Database\Factories\ServiceTranslationFactory;
use Illuminate\Database\Eloquent\Model;

class ServiceTranslation extends Model
{
    //
    use NewHasFactory;

    protected static string $factoryModel = ServiceTranslationFactory::class;


    public $timestamps = false;
    protected $fillable = ['service_id','language_code','name'];
    public function language()
    {
        return $this->hasOne(Language::class, 'code', 'language_code');
    }
}
