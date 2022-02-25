<?php

namespace App\Models\Master\ContentWord;

use App\Models\Master\PageList\PageList;
use App\Traits\NewHasFactory;
use Database\Factories\ContentWordFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ContentWord extends Model
{
    use SoftDeletes;
    use NewHasFactory;

    protected static string $factoryModel = ContentWordFactory::class;



    protected $fillable = ['word', 'status','created_by', 'updated_by', 'deleted_by'];

    public function translations(){
        return $this->hasMany(ContentWordTranslation::class, 'content_word_id', 'id');
    }

    public function translation()
    {
        return $this->hasOne(ContentWordTranslation::class, 'content_word_id', 'id');
    }

    public function pageLists()
    {
        return $this->belongsToMany(PageList::class, 'page_list_content_words', 'content_word_id', 'page_list_id');
    }
}
