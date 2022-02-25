<?php

namespace App\Models\Master\PageList;

use App\Models\Master\ContentWord\ContentWord;
use App\Traits\NewHasFactory;
use Illuminate\Database\Eloquent\Model;

class PageList extends Model
{
    //
    use NewHasFactory;


    public function translations()
    {
        return $this->hasMany(PageListTranslation::class, 'page_list_id', 'id');
    }

    public function translation()
    {
        return $this->hasOne(PageListTranslation::class, 'page_list_id', 'id');
    }

    public function contentWords()
    {
        return $this->belongsToMany(ContentWord::class, 'page_list_content_words', 'page_list_id', 'content_word_id');
    }
}
