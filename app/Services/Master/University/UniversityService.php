<?php

namespace App\Services\Master\University;

use App\Services\MainService;
use App\Repositories\Master\University\UniversityRepository;
use App\Services\Service;

class UniversityService extends Service
{
    protected MainService $mainService;

    public function __construct(
        MainService              $mainService,
        UniversityRepository     $universityRepository
    )
    {
        $this->mainService = $mainService;
        $this->repository = $universityRepository;
    }

    public function indexUniversity($data)
    {
        $language = $data['language'];
        $search = $data['search'] ?? null;
        $page = $data['page'] ?? 1;
        $rows = $data['rows'] ?? 1000;

        $universities = $this->getView()
            ->where('language_code', $language)->latest();

        if (isset($search)) {
            $universities->where('name', 'ilike', '%' . $search . '%');
        }

        return $universities->paginate($rows, ['*'], 'page name', $page);
    }

    public function storeUniversity($data)
    {
        try {
            $data['created_by'] = $this->mainService->auth::id();
            $university = $this->store($data);
            $this->storeTranslation($university->id, $data['translations'], 'university_id');
            return response()->json($university->id, 201);
        } catch (\Throwable $throwable) {
            info($throwable->getMessage());
            return response()->json('Not implemented', 501);
        }
    }

    public function showUniversity($id)
    {
        $model = $this->show($id, [$this->mainService->translation_relation]);
        if ($model) {

            $data = [
                'university_id' => $id,
                'name' => '',
            ];
            return $this->mainService->showWithTranslations($model, $data);
        } else {
            return response()->json('Not found', 404);
        }
    }

    public function updateUniversity($id, $data)
    {
        try {
            $data['updated_by'] = $this->mainService->auth::id();
            $university = $this->edit($id, $data);
            $this->editTranslation($id, $data['translations'], 'university_id');
            return response()->json($university->id);
        } catch (\Throwable $throwable) {
            info($throwable->getMessage());
            return response()->json('Not found', 404);
        }
    }

    public function listUniversity($data)
    {
        $models = $this->getView()->where('language_code',  $data['language'])->latest();
        return $this->mainService->list($data, $models, ['name']);
    }
}
