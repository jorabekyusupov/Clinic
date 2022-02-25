<?php

namespace App\Models\Master\PageList;


use App\Models\Master\Language\Language;
use App\Traits\NewHasFactory;
use Illuminate\Database\Eloquent\Model;

class PageListTranslation extends Model
{
    use NewHasFactory;

    //
    public $timestamps = false;

    public function language()
    {
        return $this->hasOne(Language::class, 'code', 'language_code');
    }
}
