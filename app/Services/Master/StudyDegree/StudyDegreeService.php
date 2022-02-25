<?php

namespace App\Services\Master\StudyDegree;

use App\Services\MainService;
use App\Repositories\Master\StudyDegree\StudyDegreeRepository;
use App\Services\Service;

class StudyDegreeService extends Service
{
    protected MainService $mainService;
    public function __construct(
        MainService               $mainService,
        StudyDegreeRepository     $studyDegreeRepository
    )
    {
        $this->mainService = $mainService;
        $this->repository = $studyDegreeRepository;
    }

    public function indexStudyDegree($data)
    {
        $language = $data['language'];
        $search = $data['search'] ?? null;
        $page = $data['page'] ?? 1;
        $rows = $data['rows'] ?? 1000;

        $studyServices = $this->getView()
            ->where('language_code', $language)->latest();

        if (isset($search)) {
            $studyServices->where('name', 'ilike', '%' . $search . '%');
        }

        return $studyServices->paginate($rows, ['*'], 'page name', $page);
    }

    public function storeStudyDegree($data)
    {

        try {
            $data['created_by'] = $this->mainService->auth::id();
            $studyDegree = $this->store($data);
            $this->storeTranslation($studyDegree->id, $data['translations'], 'study_degree_id');
            return response()->json($studyDegree->id, 201);
        } catch (\Throwable $throwable) {
            info($throwable->getMessage());
            return response()->json('Not implemented', 501);
        }
    }

    public function showStudyDegree($id)
    {
        $model = $this->show($id, [$this->mainService->translation_relation]);
        if ($model) {
            $data = [
                'study_degree_id' => $id,
                'name' => '',
            ];
            return $this->mainService->showWithTranslations($model, $data);
        } else {
            return response()->json('Not found', 404);
        }
    }

    public function updateStudyDegree($id, $data)
    {
        try {
            $data['updated_by'] = $this->mainService->auth::id();
            $studyDegree = $this->edit($id, $data);
            $this->editTranslation($id, $data['translations'], 'study_degree_id');
            return response()->json($studyDegree->id);
        } catch (\Throwable $throwable) {
            info($throwable->getMessage());
            return response()->json('Not found', 404);
        }
    }

    public function listStudyDegree($data)
    {
        $models = $this->getView()->where('language_code', $data['language'])->latest();
        return $this->mainService->list($data, $models, ['name']);
    }
}
