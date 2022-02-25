<?php

namespace App\Models\Master\Organization;

use App\Models\Master\Language\Language;
use App\Traits\NewHasFactory;
use Database\Factories\OrganizationTranslationFactory;
use Illuminate\Database\Eloquent\Model;

class OrganizationTranslation extends Model
{
    use NewHasFactory;
    protected static string $factoryModel = OrganizationTranslationFactory::class;




    public $timestamps = false;
    protected $fillable = ['organization_id','language_code', 'name', 'address'];

    public function language(){
        return $this->hasOne(Language::class, 'code', 'language_code');
    }
}
