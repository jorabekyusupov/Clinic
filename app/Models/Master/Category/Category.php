<?php

namespace App\Models\Master\Category;

use App\Models\Master\Service\Service;
use Database\Factories\CategoryFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\NewHasFactory;

class Category extends Model
{
    use NewHasFactory;
    use SoftDeletes;

    protected static string $factoryModel = CategoryFactory::class;

    protected $fillable = ['code', 'created_by', 'updated_by'];

    public function translations()
    {
        return $this->hasMany(CategoryTranslation::class, 'category_id', 'id');
    }

    public function translation()
    {
        return $this->hasOne(CategoryTranslation::class, 'category_id', 'id');
    }

    public function services()
    {
        return $this->belongsToMany(Service::class);
    }
}
