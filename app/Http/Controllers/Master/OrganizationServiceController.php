<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use App\Http\Requests\Master\OrganizationService\OrganizationServiceToggleAllRequest;
use App\Services\Master\OrganizationService\OrganizationServiceService;
use App\Http\Requests\Master\OrganizationService\OrganizationServiceIndexRequest;
use App\Http\Requests\Master\OrganizationService\OrganizationServiceToggleRequest;
use App\Http\Requests\Master\OrganizationService\OrganizationServiceStoreUpdateRequest;

class OrganizationServiceController extends Controller
{
    protected OrganizationServiceService $organizationServiceService;

    public function __construct(OrganizationServiceService $organizationServiceService)
    {
        $this->organizationServiceService = $organizationServiceService;
    }

    public function index(OrganizationServiceIndexRequest $organizationServiceIndexRequest)
    {
        return $this->organizationServiceService->indexOrganizationService($organizationServiceIndexRequest->validated());
    }

    public function store(OrganizationServiceStoreUpdateRequest $organizationServiceStoreUpdateRequest)
    {
        return $this->organizationServiceService->storeOrganizationService($organizationServiceStoreUpdateRequest->validated());
    }

    public function update($id, OrganizationServiceStoreUpdateRequest $organizationStoreUpdateRequest)
    {
        return $this->organizationServiceService->updateOrganizationService($id,
            $organizationStoreUpdateRequest->validated());
    }

    protected function toggle(OrganizationServiceToggleRequest $organizationServiceToggleRequest)
    {
        return $this->organizationServiceService->toggleOrganizationService($organizationServiceToggleRequest->validated());
    }

    protected function toggleAll(OrganizationServiceToggleAllRequest $organizationServiceToggleAllRequest)
    {
        return $this->organizationServiceService->toggleAllOrganizationService($organizationServiceToggleAllRequest->validated());
    }

    public function destroy($id)
    {
        return $this->organizationServiceService->delete($id);
    }
}
