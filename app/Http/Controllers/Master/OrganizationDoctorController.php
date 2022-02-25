<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use App\Services\Master\OrganizationDoctor\OrganizationDoctorService;
use App\Http\Requests\Master\OrganizationDoctor\OrganizationDoctorIndexRequest;
use App\Http\Requests\Master\OrganizationDoctor\OrganizationDoctorToggleRequest;
use App\Http\Requests\Master\OrganizationDoctor\OrganizationDoctorStoreUpdateRequest;

class OrganizationDoctorController extends Controller
{
    protected OrganizationDoctorService $organizationDoctorService;

    public function __construct(OrganizationDoctorService $organizationDoctorService)
    {
        $this->organizationDoctorService = $organizationDoctorService;
    }

    public function index(OrganizationDoctorIndexRequest $organizationDoctorIndexRequest)
    {
        return $this->organizationDoctorService
            ->indexOrganizationDoctor($organizationDoctorIndexRequest->validated());
    }

    public function store(OrganizationDoctorStoreUpdateRequest $organizationDoctorStoreUpdateRequest)
    {
        return $this->organizationDoctorService
            ->storeOrganizationDoctor($organizationDoctorStoreUpdateRequest->validated());
    }

    public function update($id, OrganizationDoctorStoreUpdateRequest $organizationDoctorStoreUpdateRequest)
    {
        return $this->organizationDoctorService->updateOrganizationDoctor($id,
            $organizationDoctorStoreUpdateRequest->validated());
    }

    public function toggle(OrganizationDoctorToggleRequest $organizationDoctorToggleRequest)
    {
        return $this->organizationDoctorService
            ->toggleOrganizationDoctor($organizationDoctorToggleRequest->validated());
    }

    public function destroy($id)
    {
        return $this->organizationDoctorService->delete($id);
    }
}
