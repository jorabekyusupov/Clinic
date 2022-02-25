<?php

namespace App\Services\Master\OrganizationEquipment;

use App\Services\MainService;
use App\Repositories\Master\OrganizationEquipment\OrganizationEquipmentRepository;
use App\Services\Service;

class OrganizationEquipmentService extends Service
{
    protected MainService $mainService;

    public function __construct(
        OrganizationEquipmentRepository $organizationEquipmentRepository,
        MainService $mainService
    ) {
        $this->mainService = $mainService;
        $this->repository = $organizationEquipmentRepository;
    }

    public function indexOrganizationEquipment($data)
    {
        $language = $data['language'];
        $organization_id = $data['organization_id'];
        $search = $data['search'] ?? null;
        $page = $data['page'] ?? 1;
        $rows = $data['rows'] ?? 1000;

        $organizationEquipment = $this->getView()
            ->where('language_code', $language)
            ->where('organization_id', $organization_id)
            ->latest();

        if (isset($search)) {
            $organizationEquipment->where('name', 'ilike', '%' . $search . '%');
        }

        return $organizationEquipment->paginate($rows, ['*'], 'page name', $page);
    }

    public function showOrganizationEquipment($id)
    {
        $model = $this->show($id, [$this->mainService->translation_relation]);
        if ($model) {
            $data = [
                'organization_equipment_id' => $id,
                'name' => '',
            ];
            return $this->mainService->showWithTranslations($model, $data);
        } else {
            return response()->json('Not found', 404);
        }
    }

    public function storeOrganizationEquipment($data)
    {
        try {
            $data['created_by'] = $this->mainService->auth::id();
            $organizationEquipment = $this->store($data);
            $this->storeTranslation($organizationEquipment->id, $data['translations'], 'organization_equipment_id');
            return response()->json($organizationEquipment->id, 201);
        } catch (\Throwable $throwable) {
            info($throwable->getMessage());
            return response()->json('Not implemented', 501);
        }
    }

    public function updateOrganizationEquipment($id, $data)
    {
        try {
            $data['updated_by'] = $this->mainService->auth::id();
            $organizationEquipment = $this->edit($id, $data);
            $this->editTranslation($id, $data['translations'], 'organization_equipment_id');
            return response()->json($organizationEquipment->id);
        } catch (\Throwable $throwable) {
            info($throwable->getMessage());
            return response()->json('Not found', 404);
        }

    }
}
