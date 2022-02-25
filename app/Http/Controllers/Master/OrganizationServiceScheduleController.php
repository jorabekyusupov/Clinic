<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use App\Http\Requests\Master\OrganizationServiceSchedule\IndexRequest;
use App\Http\Requests\Master\OrganizationServiceSchedule\StoreUpdateRequest;
use App\Services\Master\OrganizationServiceSchedule\OrganizationServiceScheduleService;

class OrganizationServiceScheduleController extends Controller
{
    protected OrganizationServiceScheduleService $organizationServiceScheduleService;

    public function __construct(OrganizationServiceScheduleService $organizationServiceScheduleService)
    {
        $this->organizationServiceScheduleService = $organizationServiceScheduleService;
    }

    public function index(IndexRequest $indexRequest)
    {
        return $this->organizationServiceScheduleService->indexOrganizationServiceSchedule($indexRequest->validated());
    }

    public function store(StoreUpdateRequest $storeUpdateRequest)
    {
        return $this->organizationServiceScheduleService->storeOrganizationServiceSchedule($storeUpdateRequest->validated());
    }

    public function show($id)
    {
        return $this->organizationServiceScheduleService->showOrganizationServiceSchedule($id);
    }

    public function update(StoreUpdateRequest $storeUpdateRequest, $id)
    {
        return $this->organizationServiceScheduleService
            ->updateOrganizationServiceSchedule($id, $storeUpdateRequest->validated());
    }

    public function destroy($id)
    {
        return $this->organizationServiceScheduleService->delete($id);
    }
}
