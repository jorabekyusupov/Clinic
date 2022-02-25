<?php

namespace App\Models\Master\Service;


use App\Models\Master\Category\ViewCategory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ViewService extends Model
{
    use SoftDeletes;

    public function category()
    {
        return $this->hasOne(ViewCategory::class, 'id', 'category_id');
    }
}
