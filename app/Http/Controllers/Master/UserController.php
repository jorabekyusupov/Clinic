<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use App\Http\Requests\Master\ListRequest;
use App\Services\Master\User\UserService;
use App\Http\Requests\Master\User\UserRoleRequest;
use App\Http\Requests\Master\User\UserIndexRequest;
use App\Http\Requests\Master\User\UserPermissionRequest;
use App\Http\Requests\Master\User\UserStoreUpdateRequest;

class UserController extends Controller
{
    protected UserService $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function index(UserIndexRequest $userIndexRequest)
    {
        return $this->userService->indexUser($userIndexRequest->validated());
    }

    public function show($id)
    {
        return $this->userService->showUser($id);
    }

    public function store(UserStoreUpdateRequest $userStoreUpdateRequest)
    {
        return $this->userService->storeUser($userStoreUpdateRequest->validated());
    }

    public function update($id, UserStoreUpdateRequest $userStoreUpdateRequest)
    {
        return $this->userService->updateUser($id, $userStoreUpdateRequest->validated());
    }

    public function list(ListRequest $listRequest)
    {
        return $this->userService->listUser($listRequest->validated());
    }

    public function destroy($id)
    {
        return $this->userService->delete($id);
    }

    public function profile()
    {
        return $this->userService->userProfile();
    }

    public function updateRole(UserRoleRequest $userRoleRequest)
    {
        return $this->userService->userUpdateRole($userRoleRequest->validated());
    }

    public function updatePermission(UserPermissionRequest $userPermissionRequest)
    {
        return $this->userService->userUpdatePermission($userPermissionRequest->validated());
    }
}
