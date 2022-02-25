<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use App\Http\Requests\Master\ListRequest;
use App\Services\Master\Role\RoleService;
use App\Http\Requests\Master\Role\RoleIndexRequest;
use App\Http\Requests\Master\Role\RoleToggleRequest;
use App\Http\Requests\Master\Role\RoleStoreUpdateRequest;

class RoleController extends Controller
{
    protected RoleService $roleService;

    public function __construct(RoleService $roleService)
    {
        $this->roleService = $roleService;
    }

    public function index(RoleIndexRequest $roleIndexRequest)
    {
        return $this->roleService->indexRole($roleIndexRequest->validated());
    }

    public function store(RoleStoreUpdateRequest $roleStoreUpdateRequest)
    {
        try {
            $result = $this->roleService->storeRole($roleStoreUpdateRequest->validated());
            return response()->json($result, 201);
        } catch (\Throwable $throwable) {
            info($throwable->getMessage());
            return response('Not implemented', 501);
        }
    }

    public function show($id)
    {
        return $this->roleService->showRole($id);
    }

    public function update($id, RoleStoreUpdateRequest $roleStoreUpdateRequest)
    {
        try {
            $result = $this->roleService->updateRole($id, $roleStoreUpdateRequest->validated());
            return response()->json($result);
        } catch (\Throwable $throwable) {
            info($throwable->getMessage());
            return response('Not implemented', 501);
        }
    }

    public function list(ListRequest $listRequest)
    {
        return $this->roleService->listRole($listRequest->validated());
    }

    public function toggle(RoleToggleRequest $roleToggleRequest)
    {
        return $this->roleService->toggleRole($roleToggleRequest->validated());
    }

    public function destroy($id)
    {
        return $this->roleService->softDelete($id);
    }
}
