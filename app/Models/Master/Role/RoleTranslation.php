<?php

namespace App\Models\Master\Role;

use App\Models\Master\Language\Language;
use App\Traits\NewHasFactory;
use Database\Factories\RoleTranslationFactory;
use Illuminate\Database\Eloquent\Model;

class RoleTranslation extends Model
{
    use NewHasFactory;
    protected static string $factoryModel = RoleTranslationFactory::class;


    protected $fillable = ['role_id', 'language_code', 'display_name', 'description'];

    public $timestamps = false;

    public function language()
    {
        return $this->hasOne(Language::class, 'code', 'language_code');
    }
}
