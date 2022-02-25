<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use App\Http\Requests\Master\ListRequest;
use App\Services\Master\OrganizationType\OrganizationTypeService;
use App\Http\Requests\Master\OrganizationType\OrganizationTypeIndexRequest;
use App\Http\Requests\Master\OrganizationType\OrganizationTypeStoreUpdateRequest;

class OrganizationTypeController extends Controller
{
    protected OrganizationTypeService $organizationTypeService;

    public function __construct(OrganizationTypeService $organizationTypeService)
    {
        $this->organizationTypeService = $organizationTypeService;
    }

    public function index(OrganizationTypeIndexRequest $organizationTypeIndexRequest)
    {
        return $this->organizationTypeService->indexOrganizationType($organizationTypeIndexRequest->validated());
    }

    public function show($id)
    {
        return $this->organizationTypeService->showOrganizationType($id);
    }

    public function store(OrganizationTypeStoreUpdateRequest $organizationTypeStoreUpdateRequest)
    {
        return $this->organizationTypeService->storeOrganizationType($organizationTypeStoreUpdateRequest->validated());
    }

    public function update($id, OrganizationTypeStoreUpdateRequest $organizationTypeStoreUpdateRequest)
    {
        return $this->organizationTypeService->updateOrganizationType($id,
            $organizationTypeStoreUpdateRequest->validated());
    }

    public function list(ListRequest $listRequest)
    {
        return $this->organizationTypeService->listOrganizationType($listRequest->validated());
    }

    public function destroy($id)
    {
        return $this->organizationTypeService->softDelete($id);
    }
}
