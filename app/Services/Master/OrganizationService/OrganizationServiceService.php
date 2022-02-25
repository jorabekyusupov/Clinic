<?php

namespace App\Services\Master\OrganizationService;

use App\Repositories\Master\Service\ServiceRepository;
use App\Repositories\Master\OrganizationService\OrganizationServiceRepository;
use App\Services\MainService;
use App\Services\Service;

class OrganizationServiceService extends Service
{
    protected MainService $mainService;
    private ServiceRepository $serviceRepository;

    public function __construct(
        OrganizationServiceRepository $organizationServiceRepository,
        ServiceRepository             $serviceRepository,
        MainService                   $mainService
    )
    {
        $this->repository = $organizationServiceRepository;
        $this->mainService = $mainService;
        $this->serviceRepository = $serviceRepository;
    }

    public function indexOrganizationService($data)
    {
        $organization_id = $data['organization_id'];
        $language = $data['language'];
        return $this->get()->where('organization_id', $organization_id)
            ->with([
                'service' => function ($query) use ($language) {
                    $query->where('language_code', $language);
                }
            ])
            ->get();
    }

    public function storeOrganizationService($data)
    {
        try {
            $data['created_by'] = $this->mainService->auth::id();
            $result = $this->store($data);
            return response()->json($result->id, 201);
        } catch (\Throwable $throwable) {
            info($throwable->getMessage());
            return response()->json('Not implemented', 501);
        }
    }

    public function updateOrganizationService($id, $data)
    {
        try {
            $data['updated_by'] = $this->mainService->auth::id();
            $result = $this->edit($id, $data);
            return response()->json($result->id);
        } catch (\Throwable $throwable) {
            info($throwable->getMessage());
            return response()->json('Not found', 404);
        }
    }

    public function toggleOrganizationService($data)
    {

        $organization_id = $data['organization_id'];
        $service_id = $data['service_id'];
        $type = $data['type'];

        if ($type) {
            $data['created_by'] = $this->mainService->auth::id();
            $this->store($data);
        } else {
            $this->get()->where('organization_id', $organization_id)
                ->where('service_id', $service_id)->delete();
        }

        return response()->json('Successfully');
    }

    public function toggleAllOrganizationService($data)
    {
        $organization_id = $data['organization_id'];
        $category_id = $data['category_id'];
        $type = $data['type'];
        $service_ids = $this->serviceRepository->query()->where('category_id', $category_id)->pluck('id');

        if ($type) {
            foreach ($service_ids as $service_id) {
                $organization_service = $this->get()
                    ->where('organization_id', $organization_id)
                    ->where('service_id', $service_id)->first();
                if (!$organization_service) {
                    $data['created_by'] = $this->mainService->auth::id();
                    $data['service_id'] = $service_id;
                    $this->store($data);
                }
            }
        } else {
            $this->get()->where('organization_id', $organization_id)
                ->whereIn('service_id', $service_ids)->delete();
        }

        return response()->json('Successfully');
    }

}
