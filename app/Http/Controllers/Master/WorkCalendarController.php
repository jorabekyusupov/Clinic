<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use App\Http\Requests\Master\ListRequest;
use App\Services\Master\WorkCalendar\WorkCalenderService;
use App\Http\Requests\Master\WorkCalendar\WorkCalendarIndexRequest;
use App\Http\Requests\Master\WorkCalendar\WorkCalendarStoreUpdateRequest;

class WorkCalendarController extends Controller
{
    protected WorkCalenderService $workCalenderService;

    public function __construct(WorkCalenderService $workCalenderService)
    {
        $this->workCalenderService = $workCalenderService;
    }

    public function index(WorkCalendarIndexRequest $workCalendarIndexRequest)
    {
        return $this->workCalenderService->indexWorkCalendar($workCalendarIndexRequest->validated());
    }

    public function store(WorkCalendarStoreUpdateRequest $workCalendarStoreUpdateRequest)
    {
        return $this->workCalenderService->storeWorkCalendar($workCalendarStoreUpdateRequest->validated());
    }

    public function show($id)
    {
        return $this->workCalenderService->showWorkCalendar($id);
    }

    public function update(WorkCalendarStoreUpdateRequest $workCalendarStoreUpdateRequest, $id)
    {
        return $this->workCalenderService->updateWorkCalendar($id, $workCalendarStoreUpdateRequest->validated());

    }

    public function list(ListRequest $listRequest)
    {
        return $this->workCalenderService->listWorkCalendar($listRequest->validated());
    }

    public function destroy($id)
    {
        return $this->workCalenderService->delete($id);
    }
}
