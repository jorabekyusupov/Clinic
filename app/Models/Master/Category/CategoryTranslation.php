<?php

namespace App\Models\Master\Category;

use App\Models\Master\Language\Language;
use App\Traits\NewHasFactory;
use Database\Factories\CategoryTranslationFactory;
use Illuminate\Database\Eloquent\Model;

class CategoryTranslation extends Model
{
    use NewHasFactory;
    public $timestamps = false;
    protected $fillable = ['category_id', 'language_code', 'name'];
    protected static string $factoryModel = CategoryTranslationFactory::class;

    public function language(){
        return $this->hasOne(Language::class, 'code', 'language_code');
    }
}
