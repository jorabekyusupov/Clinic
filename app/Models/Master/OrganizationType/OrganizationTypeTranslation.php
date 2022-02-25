<?php

namespace App\Models\Master\OrganizationType;

use App\Models\Master\Language\Language;
use App\Traits\NewHasFactory;
use Database\Factories\OrganizationTypeTranslationFactory;
use Illuminate\Database\Eloquent\Model;

class OrganizationTypeTranslation extends Model
{
    use NewHasFactory;

    protected static string $factoryModel = OrganizationTypeTranslationFactory::class;


    public $timestamps = false;
    protected $fillable = ['organization_type_id', 'language_code','name','description'];

    public function language(){
        return $this->hasOne(Language::class, 'code', 'language_code');
    }
}
