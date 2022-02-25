<?php

namespace App\Models\Master\ContentWord;

use App\Models\Master\Language\Language;
use App\Traits\NewHasFactory;
use Database\Factories\ContentWordTranslationFactory;
use Illuminate\Database\Eloquent\Model;

class ContentWordTranslation extends Model
{
    use NewHasFactory;

    protected static string $factoryModel = ContentWordTranslationFactory::class;



    public $timestamps = false;
    protected $fillable = ['content_word_id', 'language_code', 'translation'];

    public static function returnContentWord($language, $word)
    {
        $message = ContentWordTranslation::select()->whereHas('contentWord', function ($q) use ($word) {
            $q->where('word', $word);
        })->where('language_code', $language)->first();
        return $message ? $message->translation : $word;
    }

    public function language()
    {
        return $this->hasOne(Language::class, 'code', 'language_code');
    }

    public function contentWord()
    {
        return $this->hasOne(ContentWord::class, 'id', 'content_word_id');
    }
}
