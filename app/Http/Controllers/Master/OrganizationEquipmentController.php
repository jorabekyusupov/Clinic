<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use App\Services\Master\OrganizationEquipment\OrganizationEquipmentService;
use App\Http\Requests\Master\OrganizationEquipment\OrganizationEquipmentIndexRequest;
use App\Http\Requests\Master\OrganizationEquipment\OrganizationEquipmentStoreUpdateRequest;

class OrganizationEquipmentController extends Controller
{
    protected OrganizationEquipmentService $organizationEquipmentService;

    public function __construct(OrganizationEquipmentService $organizationEquipmentService)
    {
        $this->organizationEquipmentService = $organizationEquipmentService;
    }

    public function index(OrganizationEquipmentIndexRequest $organizationEquipmentIndexRequest)
    {
        return $this->organizationEquipmentService
            ->indexOrganizationEquipment($organizationEquipmentIndexRequest->validated());
    }

    public function store(OrganizationEquipmentStoreUpdateRequest $organizationEquipmentStoreUpdateRequest)
    {
        return $this->organizationEquipmentService
            ->storeOrganizationEquipment($organizationEquipmentStoreUpdateRequest->validated());
    }

    public function show($id)
    {
        return $this->organizationEquipmentService->showOrganizationEquipment($id);
    }

    public function update($id, OrganizationEquipmentStoreUpdateRequest $organizationEquipmentStoreUpdateRequest)
    {
        return $this->organizationEquipmentService
            ->updateOrganizationEquipment($id, $organizationEquipmentStoreUpdateRequest->validated());
    }

    public function destroy($id)
    {
        return $this->organizationEquipmentService->softDelete($id);
    }
}
