<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use App\Services\MainService;
use App\Http\Requests\Master\ListRequest;
use App\Services\Master\Category\CategoryService;
use App\Http\Requests\Master\Category\CategoryIndexRequest;
use App\Http\Requests\Master\Category\CategoryStoreUpdateRequest;

class CategoryController extends Controller
{
    protected CategoryService $categoryService;
    protected MainService $mainService;

    public function __construct(CategoryService $categoryService, MainService $mainService)
    {
        $this->categoryService = $categoryService;
        $this->mainService = $mainService;
    }

    public function index(CategoryIndexRequest $categoryIndexRequest)
    {
        return $this->categoryService->indexCategory($categoryIndexRequest->validated());
    }

    public function show($id)
    {
        return $this->categoryService->CategoryShow($id);
    }

    public function store(CategoryStoreUpdateRequest $categoryStoreUpdateRequest)
    {
        return $this->categoryService->storeCategory($categoryStoreUpdateRequest->validated());
    }

    public function update($id, CategoryStoreUpdateRequest $categoryStoreUpdateRequest)
    {
        return $this->categoryService->updateCategory($id, $categoryStoreUpdateRequest->validated());
    }

    public function destroy($id)
    {
        return $this->categoryService->softDelete($id);
    }

    public function list(ListRequest $listRequest)
    {
        return $this->categoryService->listCategory($listRequest->validated());
    }
}
