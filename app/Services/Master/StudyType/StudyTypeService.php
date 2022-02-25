<?php

namespace App\Services\Master\StudyType;

use App\Services\MainService;
use App\Repositories\Master\StudyType\StudyTypeRepository;
use App\Services\Service;


class StudyTypeService extends Service
{
    protected MainService $mainService;

    public function __construct(
        MainService             $mainService,
        StudyTypeRepository     $studyTypeRepository
    ) {
        $this->mainService = $mainService;
        $this->repository = $studyTypeRepository;
    }

    public function indexStudyType($data)
    {
        $language = $data['language'];
        $search = $data['search'] ?? null;
        $page = $data['page'] ?? 1;
        $rows = $data['rows'] ?? 1000;

        $studyTypes = $this->getView()
            ->where('language_code', $language)->latest();

        if (isset($search)) {
            $studyTypes->where('name', 'ilike', '%' . $search . '%');
        }

        return $studyTypes->paginate($rows, ['*'], 'page name', $page);
    }


    public function showStudyType($id)
    {
        $model = $this->show($id, [$this->mainService->translation_relation]);
        if ($model) {
            $data = [
                'study_type_id' => $id,
                'name' => '',
            ];
            return $this->mainService->showWithTranslations($model, $data);
        } else {
            return response()->json('Not found', 404);
        }
    }

    public function storeStudyType($data)
    {
        try {
            $data['created_by'] = $this->mainService->auth::id();
            $studyType = $this->store($data);
            $this->storeTranslation($studyType->id, $data['translations'], 'study_type_id');
            return response()->json($studyType->id, 201);
        } catch (\Throwable $throwable) {
            info($throwable->getMessage());
            return response()->json('Not implemented', 501);
        }
    }

    public function updateStudyType($id, $data)
    {
        try {
            $data['updated_by'] = $this->mainService->auth::id();
            $studyType = $this->edit($id, $data);
            $this->editTranslation($id, $data['translations'], 'study_type_id');
            return response()->json($studyType->id);
        } catch (\Throwable $throwable) {
            info($throwable->getMessage());
            return response()->json('Not found', 404);
        }
    }

    public function listStudyType($data)
    {
        $models = $this->getView()->where('language_code', $data['language'])->latest();
        return $this->mainService->list($data, $models, ['name']);
    }
}
