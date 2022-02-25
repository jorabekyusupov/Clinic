<?php

namespace App\Models\Master\Permission;

use App\Models\Master\Language\Language;
use App\Traits\NewHasFactory;
use Database\Factories\PermissionTranslationFactory;
use Illuminate\Database\Eloquent\Model;

class PermissionTranslation extends Model
{
    use NewHasFactory;

    protected static string $factoryModel = PermissionTranslationFactory::class;


    public $timestamps = false;

    protected $fillable = ['permission_id', 'language_code', 'display_name', 'description'];

    public function language()
    {
        return $this->hasOne(Language::class, 'code', 'language_code');
    }
}
