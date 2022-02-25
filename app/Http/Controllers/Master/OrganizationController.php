<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use App\Http\Requests\Master\ListRequest;
use App\Services\Master\Organization\OrganizationService;
use App\Http\Requests\Master\Organization\OrganizationIndexRequest;
use App\Http\Requests\Master\Organization\OrganizationStoreUpdateRequest;

class OrganizationController extends Controller
{
    protected OrganizationService $organizationService;

    public function __construct(OrganizationService $organizationService)
    {
        $this->organizationService = $organizationService;
    }

    public function index(OrganizationIndexRequest $organizationIndexRequest)
    {
        return $this->organizationService->indexOrganization($organizationIndexRequest->validated());
    }

    public function show($id)
    {
        return $this->organizationService->showOrganization($id);
    }

    public function store(OrganizationStoreUpdateRequest $organizationStoreUpdateRequest)
    {
        return $this->organizationService->storeOrganization($organizationStoreUpdateRequest->validated());
    }

    public function update($id, OrganizationStoreUpdateRequest $organizationStoreUpdateRequest)
    {
        return $this->organizationService->updateOrganization($id, $organizationStoreUpdateRequest->validated());
    }

    public function destroy($id)
    {
        return $this->organizationService->delete($id);
    }

    public function list(ListRequest $listRequest)
    {
        return $this->organizationService->listOrganization($listRequest->validated());
    }
}
