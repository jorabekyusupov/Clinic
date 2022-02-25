<?php

namespace App\Repositories\Master\Category;

use App\Models\Master\Category\Category;
use App\Models\Master\Category\CategoryTranslation;
use App\Models\Master\Category\ViewCategory;
use App\Repositories\Repository;

class CategoryRepository extends Repository
{
    public function __construct(Category $category, CategoryTranslation $categoryTranslation, ViewCategory $viewCategory)
    {
        $this->model = $category;
        $this->modelTranslation = $categoryTranslation;
        $this->modelView = $viewCategory;
    }
}
