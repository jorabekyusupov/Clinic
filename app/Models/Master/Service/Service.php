<?php

namespace App\Models\Master\Service;

use App\Models\Master\Category\Category;
use App\Traits\NewHasFactory;
use Database\Factories\ServiceFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Service extends Model
{
    use SoftDeletes;
    use NewHasFactory;

    protected static string $factoryModel = ServiceFactory::class;

    protected $fillable = ['code', 'category_id', 'created_by', 'updated_by', 'deleted_by'];

    public function translations()
    {
        return $this->hasMany(ServiceTranslation::class, 'service_id', 'id');
    }

    public function translation()
    {
        return $this->hasOne(ServiceTranslation::class, 'service_id', 'id');
    }

    public function category()
    {
        return $this->hasOne(Category::class);
    }
}
