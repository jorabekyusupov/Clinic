<?php

namespace App\Services\Master\OrganizationServiceSchedule;

use App\Repositories\Master\OrganizationServiceSchedule\OrganizationServiceScheduleRepository;
use App\Services\MainService;
use App\Services\Service;

class OrganizationServiceScheduleService extends Service
{
    protected MainService $mainService;
    public function __construct(OrganizationServiceScheduleRepository $organizationServiceScheduleRepository, MainService $mainService)
    {
        $this->repository = $organizationServiceScheduleRepository;
        $this->mainService = $mainService;
    }

    public function indexOrganizationServiceSchedule($data)
    {
        $organization_id = $data['organization_id'];
        $page = $data['page'] ?? 1;
        $rows = $data['rows'] ?? 1000;

        $organization_schedule_service = $this->repository->query()
            ->where('organization_id', $organization_id);

        return $organization_schedule_service->paginate($rows, ['*'], 'page name', $page);
    }

    public function storeOrganizationServiceSchedule($data)
    {
        try {
            $data['created_by'] = $this->mainService->auth->id();
            $organization_schedule_service = $this->store($data);
            return response()->json($organization_schedule_service->id, 201);
        } catch (\Throwable $throwable) {
            info($throwable->getMessage());
            return response()->json('Not implemented', 501);
        }
    }

    public function showOrganizationServiceSchedule($id)
    {
        $organization_schedule_service = $this->show($id);
        if ($organization_schedule_service) {
            return $organization_schedule_service;
        } else {
            return response()->json('Not found', 404);
        }
    }

    public function updateOrganizationServiceSchedule($id, $data)
    {
        try {
            $data['updated_by'] = $this->mainService->auth->id();
            $organization_schedule_service = $this->edit($id, $data);
            return response()->json($organization_schedule_service->id);
        } catch (\Throwable $throwable) {
            info($throwable->getMessage());
            return response()->json('Not found', 404);
        }
    }
}
