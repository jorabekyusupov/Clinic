<?php

namespace App\Services\Master\User;

use App\Services\MainService;
use App\Repositories\Master\User\UserRepository;
use App\Services\Service;

class UserService extends Service
{
    private $relations = [
        'person:id,first_name,last_name,middle_name',
        'roles:id,name', 'roles.permissions:name', 'permissions:name'
    ];

    protected $mainService, $roleUserService, $permissionUserService;

    public function __construct(
        MainService           $mainService,
        UserRepository        $userRepository,
        RoleUserService       $roleUserService,
        PermissionUserService $permissionUserService
    )
    {
        $this->mainService = $mainService;
        $this->repository = $userRepository;
        $this->roleUserService = $roleUserService;
        $this->permissionUserService = $permissionUserService;
    }

    public function listUser($data)
    {
        $originalEvent = $data['originalEvent'];
        $page = isset($originalEvent['page']) ? $originalEvent['page'] + 1 : 1;
        $rows = $originalEvent['rows'] ?? 1000;
        $global_search = $originalEvent['globalsearch'] ?? null;

        $models = $this->get($this->relations)->orderBy('id');

        $this->mainService->filterModels($models, $originalEvent);

        if (isset($global_search)) {
            $models = $models->whereHas('person', function ($query) use ($global_search) {
                $query->where('first_name', 'ilike', '%' . $global_search . '%')
                    ->orWhere('last_name', 'ilike', '%' . $global_search . '%')
                    ->orWhere('middle_name', 'ilike', '%' . $global_search . '%');
            })
                ->orWhere('username', 'ilike', '%' . $global_search . '%')
                ->orWhere('email', 'ilike', '%' . $global_search . '%');
        }
        return $models->paginate($rows, ['*'], 'page name', $page);
    }

    public function indexUser($data)
    {
        $search = $data['search'] ?? null;
        $page = $data['page'] ?? 1;
        $rows = $data['rows'] ?? 1000;
        $users = $this->get($this->relations)->orderBy('id');

        if (isset($search)) {
            $users->whereHas([
                'person' => function ($query) use ($search) {
                    $query->where('last_name', 'ilike', $search)
                        ->orWhere('first_name', 'ilike', $search)
                        ->orWhere('middle_name', 'ilike', $search);
                }
            ]);
        }

        return $users->paginate($rows, ['*'], 'page name', $page);
    }

    public function showUser($id)
    {
        return $this->show($id);
    }

    public function storeUser($data)
    {
        try {
            $data['created_by'] = $this->mainService->auth::id();
            $data['password'] = bcrypt($data['password']);
            $user = $this->store($data);
            return response()->json($user->id, 201);
        } catch (\Throwable $throwable) {
            info($throwable->getMessage());
            return response()->json('Not implemented', 501);
        }
    }

    public function updateUser($id, $data)
    {
        try {
            $data['password'] = bcrypt($data['password']);
            $data['updated_by'] = $this->mainService->auth::id();
            $user = $this->edit($id, $data);
            return response()->json($user->id);
        } catch (\Throwable $throwable) {
            info($throwable->getMessage());
            return response()->json('Not found', 404);
        }
    }

    public function userProfile()
    {
        return $this->get(['roles.permissions:name', 'permissions', 'person'])
            ->where('id', $this->mainService->auth::id())->first();
    }

    public function userUpdateRole($data)
    {
        $type = $data['type'];
        $user_id = $data['user_id'];
        $role_id = $data['role_id'];
        try {
            if ($type) {
                $data['user_type'] = 'App\Models\User';
                $this->roleUserService->store($data);
            } else {
                $this->roleUserService->get()->where('role_id', $role_id)
                    ->where('user_id', $user_id)->delete();
            }
            return response()->json('Successfully saved');
        } catch (\Throwable $throwable) {
            info($throwable->getMessage());
            return response()->json('Not found', 404);
        }
    }

    public function userUpdatePermission($data)
    {
        $user_id = $data['user_id'];
        $permission_id = $data['permission_id'];
        $type = $data['type'];
        try {
            if ($type) {
                $data['user_type'] = 'App\Models\User';
                $this->permissionUserService->store($data);
            } else {
                $permission_user = $this->permissionUserService->get()
                    ->where('permission_id', $permission_id)
                    ->where('user_id', $user_id)->first();
                $permission_user->delete();
            }
            return response()->json('Successfully saved');
        } catch (\Throwable $throwable) {
            return response()->json('Not found', 404);
        }
    }
}
