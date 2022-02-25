<?php

namespace App\Models\Master\Category;

use App\Models\Master\Service\ViewService;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ViewCategory extends Model
{
    use SoftDeletes;

    protected $table = 'view_categories';

    public function services()
    {
        return $this->hasMany(ViewService::class, 'category_id', 'id');
    }
}
