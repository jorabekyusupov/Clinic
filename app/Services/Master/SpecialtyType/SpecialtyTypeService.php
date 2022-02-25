<?php

namespace App\Services\Master\SpecialtyType;

use App\Repositories\Master\SpecialtyType\SpecialtyTypeRepository;
use App\Services\MainService;
use App\Services\Service;


class SpecialtyTypeService extends Service
{
    protected MainService $mainService;

    public function __construct(
        SpecialtyTypeRepository     $specialtyTypeRepository,
        MainService                 $mainService
    ) {
        $this->repository = $specialtyTypeRepository;
        $this->mainService = $mainService;
    }

    public function indexSpecialtyType($data)
    {
        $search = $data['search'] ?? null;
        $language = $data['language'];

        return $this->getView()->whereNull('deleted_at')
            ->where('name', 'ilike', '%' . $search . '%')
            ->where('language_code', $language)
            ->orderBy('id')
            ->paginate(20);
    }

    public function showSpecialtyType($id)
    {
        $model = $this->show($id, [$this->mainService->translation_relation]);
        if ($model) {
            $data = [
                'specialty_type_id' => $id,
                'name' => ''
            ];
            $this->mainService->showWithTranslations($model, $data);
            return response()->json($model);
        } else {
            return response()->json('Not found', 404);
        }
    }

    public function storeSpecialtyType($data)
    {
        try {
            $data['created_by'] = $this->mainService->auth::id();
            $specialty_type = $this->store($data);
            $this->storeTranslation($specialty_type->id, $data['translations'], 'specialty_type_id');
            return response()->json($specialty_type->id, 201);
        } catch (\Throwable $throwable) {
            info($throwable->getMessage());
            return response()->json('Not implemented', 501);
        }
    }

    public function updateSpecialtyType($id, $data)
    {
        try {
            $data['updated_by'] = $this->mainService->auth::id();
            $specialty_type = $this->edit($id, $data);
            $this->editTranslation($id, $data['translations'], 'specialty_type_id');
            return response()->json($specialty_type->id);
        } catch (\Throwable $throwable) {
            info($throwable->getMessage());
            return response()->json('not found', 500);
        }
    }

    public function listSpecialtyType($data)
    {
        $models = $this->getView()->whereNull('deleted_at')->where('language_code', $data['language']);
        return $this->mainService->list($data, $models, ['name']);
    }
}
