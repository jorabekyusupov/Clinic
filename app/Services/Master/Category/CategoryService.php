<?php

namespace App\Services\Master\Category;


use App\Services\MainService;
use App\Repositories\Master\Category\CategoryRepository;
use App\Services\Service;

class CategoryService extends Service
{

    protected MainService $mainService;

    public function __construct(MainService $mainService, CategoryRepository $categoryRepository)
    {
        $this->repository = $categoryRepository;
        $this->mainService = $mainService;
    }

    public function indexCategory($data)
    {
        $search = $data['search'];
        $language = $data['language'];
        $page = $data['page'] ?? 1;
        $rows = $data['rows'] ?? 1000;
        try {
            $category = $this->getView()
                ->where('language_code', $language)
                ->orderBy('id');
            if ($search) {
                $category->where('name', 'ilike', '%' . $search . '%');
            }
            return $category->paginate($rows, ['*'], 'page name', $page);
        } catch (\Throwable $throwable) {
            return response()->json($throwable->getMessage(), 500);
        }
    }

    public function CategoryShow($id)
    {
        $model = $this->show($id, [$this->mainService->translation_relation]);
        if ($model) {
            $data = [
                'category_id' => $id,
                'name' => ''
            ];
            $this->mainService->showWithTranslations($model, $data);
            return response()->json($model);
        } else {
            return response()->json('Not found', 404);
        }
    }

    public function storeCategory($data)
    {
        try {
            $data['created_by'] = $this->mainService->auth::id();
            $category = $this->store($data);
            $this->storeTranslation($category->id, $data['translations'], 'category_id');
            return response()->json($category->id, 201);
        } catch (\Throwable $throwable) {
            info($throwable->getMessage());
            return response()->json('Not implemented', 501);
        }
    }

    public function updateCategory($id, $data)
    {
        try {
            $data['updated_by'] = $this->mainService->auth::id();
            $category = $this->edit($id, $data);
            $this->editTranslation($id, $data['translations'], 'category_id');
            return response()->json($category->id);
        } catch (\Throwable $throwable) {
            info($throwable->getMessage());
            return response()->json('Not found', 404);
        }
    }

    public function listCategory($data)
    {
        $models = $this->getView()
            ->whereNull('deleted_at')
            ->with('services')
            ->where('language_code', $data['language']);
        return  $this->mainService->list($data, $models, ['name', 'code']);
    }
}
