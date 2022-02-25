<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use App\Http\Requests\Master\ListRequest;
use App\Services\Master\Permission\PermissionService;
use App\Http\Requests\Master\Permission\PermissionIndexRequest;
use App\Http\Requests\Master\Permission\PermissionStoreUpdateRequest;

class PermissionController extends Controller
{
    protected PermissionService $permissionService;

    public function __construct(PermissionService $permissionService)
    {
        $this->permissionService = $permissionService;
    }

    public function index(PermissionIndexRequest $permissionIndexRequest)
    {
        return $this->permissionService->indexPermission($permissionIndexRequest->validated());
    }

    public function store(PermissionStoreUpdateRequest $permissionStoreUpdateRequest)
    {
        return $this->permissionService->storePermission($permissionStoreUpdateRequest->validated());
    }

    public function show($id)
    {
        return $this->permissionService->showPermission($id);
    }

    public function update($id, PermissionStoreUpdateRequest $permissionStoreUpdateRequest)
    {
        return $this->permissionService->updatePermission($id, $permissionStoreUpdateRequest->validated());
    }

    public function list(ListRequest $listRequest)
    {
        return $this->permissionService->listPermission($listRequest->validated());
    }

    public function destroy($id)
    {
        return $this->permissionService->softDelete($id);
    }
}
