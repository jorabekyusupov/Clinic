<?php

namespace App\Services\Master\WorkCalendar;

use App\Services\MainService;
use App\Repositories\Master\WorkCalendar\WorkCalendarRepository;
use App\Services\Service;

class WorkCalenderService extends Service
{
    protected MainService $mainService;

    public function __construct(
        MainService $mainService,
        WorkCalendarRepository $workCalendarRepository
    ) {
        $this->mainService = $mainService;
        $this->repository = $workCalendarRepository;
    }

    public function indexWorkCalendar($data)
    {
        $search = $data['search'] ?? null;
        $page = $data['page'] ?? 1;
        $rows = $data['rows'] ?? 1000;

        $work_calendars = $this->repository->query();

        if (isset($search)) {
            $work_calendars->where('holiday_name', 'ilike', '%'.$search.'%');
        }

        return $work_calendars->paginate($rows, ['*'], 'page name', $page);
    }

    public function storeWorkCalendar($data)
    {
        try {
            $work_calendar = $this->store($data);
            return response()->json($work_calendar->id, 201);
        } catch (\Throwable $throwable) {
            info($throwable->getMessage());
            return response()->json('Not implemented', 501);
        }

    }

    public function showWorkCalendar($id)
    {
        $work_calendar = $this->show($id);
        if ($work_calendar) {
            return $work_calendar;
        } else {
            return response()->json('Not found', 404);
        }
    }

    public function updateWorkCalendar($id, $data)
    {
        try {
            $work_calendar = $this->edit($id, $data);
            return response()->json($work_calendar->id);
        } catch (\Throwable $throwable) {
            info($throwable->getMessage());
            return response()->json('Not found', 404);

        }

    }

    public function listWorkCalendar($data)
    {
        // return $data;
        $originalEvent = $data['originalEvent'];
        $page = isset($originalEvent['page']) ? $originalEvent['page'] + 1 : 1;
        $rows = $originalEvent['rows'] ?? 1000;
        $models = $this->repository->query();
        $models = $this->mainService->filterModels($models, $originalEvent);
        return $models->paginate($rows, ['*'], 'page name', $page);
    }
}
