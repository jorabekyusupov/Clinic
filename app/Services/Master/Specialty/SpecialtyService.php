<?php

namespace App\Services\Master\Specialty;

use App\Services\MainService;
use App\Repositories\Master\Specialty\SpecialtyRepository;
use App\Services\Service;

class SpecialtyService extends Service
{
    protected MainService $mainService;

    public function __construct(
        MainService             $mainService,
        SpecialtyRepository     $specialtyRepository
    )
    {
        $this->repository = $specialtyRepository;
        $this->mainService = $mainService;
    }

    public function indexSpecialty($data)
    {
        $filter = $data['search'];
        $language = $data['language'];
        $rows = $data['rows'] ?? 1000;
        $page = $data['page'] ?? 1;
        $specialties = $this->getView()->where('language_code', $language)
            ->with([
                'specialtyType' => function ($q) use ($language) {
                    $q->select('id', 'name')->where('language_code', $language);
                }
            ]);
        if (isset($filter)) // Specialty type bo'yicha ham search qo'shish kerak !
        {
            $specialties->where('language_code', $language)
                ->where('name', 'ilike', '%' . $filter . '%');
        }

        return $specialties->paginate($rows, ['*'], 'page name', $page);
    }

    public function showSpecialty($id)
    {
        $model = $this->show($id, [$this->mainService->translation_relation]);
        if ($model) {
            $data = [
                'specialty_id' => $id,
                'name' => ''
            ];
            $this->mainService->showWithTranslations($model, $data);
            return response()->json($model);
        } else {
            return response()->json('Not found', 404);
        }
    }

    public function storeSpecialty($data)
    {
        try {
            $data['created_by'] = $this->mainService->auth::id();
            $specialty = $this->store($data);
            $this->storeTranslation($specialty->id, $data['translations'], 'specialty_id');
            return response()->json($specialty->id, 201);
        } catch (\Throwable $throwable) {
            info($throwable->getMessage());
            return response()->json('Not implemented', 501);
        }
    }

    public function updateSpecialty($id, $data)
    {
        try {
            $data['updated_by'] = $this->mainService->auth::id();
            $specialty = $this->edit($id, $data);
            $this->editTranslation($id, $data['translations'], 'specialty_id');
            return response()->json($specialty->id);
        } catch (\Throwable $throwable) {
            info($throwable->getMessage());
            return response()->json('Not found', 404);
        }
    }

    public function listSpecialty($data)
    {
        $language = $data['language'];
        $models = $this->getView()->where('language_code', $language)
            ->with([
                'specialtyType' => function ($query) use ($language) {
                    $query->select('id', 'name')->where('language_code', $language);
                }
            ])->orderBy('id');
        return $this->mainService->list($data, $models, ['name']);
    }
}
