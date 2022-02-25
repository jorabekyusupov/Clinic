<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use App\Http\Requests\Master\ListRequest;
use App\Services\Master\WeeklySchedule\WeeklyScheduleService;
use App\Http\Requests\Master\WeeklySchedule\WeeklyScheduleIndexRequest;
use App\Http\Requests\Master\WeeklySchedule\WeeklyScheduleStoreUpdateRequest;

class WeeklyScheduleController extends Controller
{
    protected WeeklyScheduleService $weeklyScheduleService;

    public function __construct(WeeklyScheduleService $weeklyScheduleService)
    {
        $this->weeklyScheduleService = $weeklyScheduleService;
    }

    public function index(WeeklyScheduleIndexRequest $weeklyScheduleIndexRequest)
    {
        return $this->weeklyScheduleService->indexWeeklySchedule($weeklyScheduleIndexRequest->validated());
    }

    public function show($id)
    {
        return $this->weeklyScheduleService->showWeeklySchedule($id);
    }

    public function store(WeeklyScheduleStoreUpdateRequest $weeklyScheduleStoreUpdateRequest)
    {
        return $this->weeklyScheduleService->storeWeeklySchedule($weeklyScheduleStoreUpdateRequest->validated());
    }

    public function update($id, WeeklyScheduleStoreUpdateRequest $weeklyScheduleStoreUpdateRequest)
    {
        return $this->weeklyScheduleService
            ->updateWeeklySchedule($id, $weeklyScheduleStoreUpdateRequest->validated());
    }

    public function destroy($id)
    {
        return $this->weeklyScheduleService->softDelete($id);
    }

    public function list(ListRequest $listRequest)
    {
        return $this->weeklyScheduleService->listWeeklySchedule($listRequest->validated());
    }
}
