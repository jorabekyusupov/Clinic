<?php

namespace App\Services\Master\Service;

use App\Services\MainService;
use App\Repositories\Master\Service\ServiceRepository;
use App\Services\Service;

class ServiceService extends Service
{
    protected MainService $mainService;

    public function __construct(
        ServiceRepository     $serviceRepository,
        MainService           $mainService
    ) {
        $this->repository = $serviceRepository;
        $this->mainService = $mainService;
    }

    public function listService($data)
    {

        $models = $this->getView()->whereNull('deleted_at')
            ->with('category')
            ->where('language_code', $data['language']);
        return $this->mainService->list($data, $models, ['name', 'code']);
    }

    public function indexService($data)
    {
        $category_id = $data['category_id'] ?? null;
        $not_in_category = $data['not_in_category'] ?? null;
        $language = $data['language'];
        $search = $data['search'];
        $page = $data['page'] ?? 1;
        $rows = $data['rows'] ?? 1000;

        $services = $this->getView()->whereNull('deleted_at')->where('language_code', $language)->orderBy('id');

        if (isset($search)) {
            $services->where('name', 'ilike', '%' . $search . '%');
        }

        if (isset($category_id) && $category_id) {
            if (!$not_in_category) {
                $services->where('category_id', $category_id);
            }
            if ($not_in_category) {
                $services->whereNot('category_id', $category_id);
            }
        }

        return $services->paginate($rows == '-1' ? 1000000 : $rows, ['*'], 'page name', $page);
    }

    public function showService($id)
    {
        $model = $this->show($id, [$this->mainService->translation_relation]);
        if ($model) {
            $data = [
                'service_id' => $id,
                'name' => ''
            ];
            $this->mainService->showWithTranslations($model, $data);
            return response()->json($model);
        } else {
            return response()->json('Not found', 404);
        }
    }

    public function storeService($data)
    {
        try {
            $data['created_by'] = $this->mainService->auth::id();
            $service = $this->store($data);
            $this->storeTranslation($service->id, $data['translations'], 'service_id');
            return response()->json($service->id, 201);
        } catch (\Throwable $throwable) {
            info($throwable->getMessage());
            return response()->json('Not implemented', 501);
        }
    }

    public function updateService($id, $data)
    {
        try {
            $data['updated_by'] = $this->mainService->auth::id();
            $service = $this->edit($id, $data);
            $this->editTranslation($id, $data['translations'], 'service_id');
            return response()->json($service->id);
        } catch (\Throwable $throwable) {
            info($throwable->getMessage());
            return response()->json('Not found', 404);
        }
    }
}
