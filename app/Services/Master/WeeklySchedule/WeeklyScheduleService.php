<?php

namespace App\Services\Master\WeeklySchedule;

use App\Services\MainService;
use App\Repositories\Master\WeeklySchedule\WeeklyScheduleRepository;
use App\Services\Service;

class WeeklyScheduleService extends Service
{
    protected MainService $mainService;

    public function __construct(
        MainService                  $mainService,
        WeeklyScheduleRepository     $weeklyScheduleRepository
    ) {
        $this->mainService = $mainService;
        $this->repository = $weeklyScheduleRepository;
    }

    public function listWeeklySchedule($data)
    {
        $models = $this->getView()->whereNull('deleted_at')->where('language_code', $data['language']);
        return $this->mainService->list($data, $models, ['name']);
    }

    public function indexWeeklySchedule($data)
    {
        $search = $data['search'] ?? null;
        $language = $data['language'];
        try {
            $category = $this->getView()->whereNull('deleted_at')
                ->where('language_code', $language)
                ->orderBy('id');
            if ($search) {
                $category->where('name', 'ilike', '%' . $search . '%');
            }
            return $category->get();
        } catch (\Throwable $throwable) {
            return response()->json($throwable->getMessage(), 500);
        }
    }

    public function showWeeklySchedule($id)
    {
        $model = $this->show($id, [$this->mainService->translation_relation]);
        if ($model) {
            $data = [
                'weekly_schedule_id' => $id,
                'name' => ''
            ];
            $this->mainService->showWithTranslations($model, $data);
            return response()->json($model);
        } else {
            return response()->json('Not found', 404);
        }
    }

    public function storeWeeklySchedule($data)
    {
        try {
            $data['created_by'] = $this->mainService->auth::id();
            $weekly_schedule = $this->store($data);
            $this->storeTranslation($weekly_schedule->id, $data['translations'], 'weekly_schedule_id');
            return response()->json($weekly_schedule->id, 201);
        } catch (\Throwable $throwable) {
            info($throwable->getMessage());
            return response()->json('Not implemented', 501);
        }
    }

    public function updateWeeklySchedule($id, $data)
    {
        try {
            $data['updated_by'] = $this->mainService->auth::id();
            $weekly_schedule = $this->edit($id, $data);
            $this->editTranslation($id, $data['translations'], 'weekly_schedule_id');
            return response()->json($weekly_schedule->id);
        } catch (\Throwable $throwable) {
            info($throwable->getMessage());
            return response()->json('Not found', 404);
        }
    }
}
