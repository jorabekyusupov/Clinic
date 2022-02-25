<?php

namespace App\Services\Master\Role;

use App\Services\MainService;
use App\Repositories\Master\Role\RoleRepository;
use App\Repositories\Master\PermissionRole\PermissionRoleRepository;
use App\Services\Service;

class RoleService extends Service
{
    protected MainService $mainService;
    protected PermissionRoleRepository $permissionRoleRepository;

    public function __construct(
        MainService              $mainService,
        RoleRepository           $roleRepository,
        PermissionRoleRepository $permissionRoleRepository
    ) {
        $this->mainService = $mainService;
        $this->repository = $roleRepository;
        $this->permissionRoleRepository = $permissionRoleRepository;
    }

    public function indexRole($data)
    {
        $language = $data['language'];
        $search = $data['search'] ?? null;
        (int)$user_id = $data['user_id'] ?? null;
        (int)$not_in_user = $data['not_in_user'] ?? null;
        $page = $data['page'] ?? 1;
        $rows = $data['rows'] ?? 1000;

        $roles = $this->getView()
            ->where('language_code', $language)->latest();

        if (isset($search)) {
            $roles->where(function ($q) use ($search) {
                $q->where('name', 'ilike', '%' . $search . '%')
                    ->orWhere('display_name', 'ilike', '%' . $search . '%')
                    ->orWhere('description', 'ilike', '%' . $search . '%');
            });
        }

        if (isset($user_id)) {
            if (!$not_in_user) {
                $roles->whereHas('user', function ($q) use ($user_id) {
                    $q->where('user_id', $user_id);
                });
            }
            if ($not_in_user) {
                $roles->whereDoesntHave('user', function ($q) use ($user_id) {
                    $q->where('user_id', $user_id);
                });
            }
        }

        return $roles->paginate($rows, ['*'], 'page name', $page);
    }

    public function showRole($id)
    {
        $model = $this->show($id, [$this->mainService->translation_relation]);
        if ($model) {
            $data = [
                'role_id' => $id,
                'display_name' => '',
                'description' => '',
            ];
            return response()->json($this->mainService->showWithTranslations($model, $data));
        } else {
            return response()->json('Not found', 404);
        }
    }

    public function storeRole($data)
    {
        try {

            $data['created_by'] = $this->mainService->auth::id();
            $role = $this->store($data);
            $this->editTranslation($role->id, $data['translations'], 'role_id');
            return response()->json($role->id, 201);
        } catch (\Throwable $throwable) {
            info($throwable->getMessage());
            return response()->json('Not implemented', 501);
        }
    }

    public function updateRole($id, $data)
    {
        try {
            $data['updated_by'] = $this->mainService->auth::id();
            $role = $this->edit($id, $data);
            $this->editTranslation($id, $data['translations'], 'role_id');
            return response()->json($role->id);
        } catch (\Throwable $throwable) {
            info($throwable->getMessage());
            return response()->json('Not found', 404);
        }
    }

    public function listRole($data)
    {
        $models = $this->getView()->where('language_code', $data['language'])->latest();
        return $this->mainService->list($data, $models, ['name', 'display_name', 'description']);
    }

    public function toggleRole($data)
    {
        $type = $data['type'];
        $role_id = $data['role_id'];
        $permission_id = $data['permission_id'];

        if ($type == 1) {
            $this->permissionRoleRepository->create($data);
            return response()->json('Successfully created', 201);
        } elseif ($type == 0) {
            $this->permissionRoleRepository->query()
                ->where('role_id', $role_id)
                ->where('permission_id', $permission_id)->delete();
            return response()->json('successfly');
        } else {
            return response()->json('not found', 404);
        }
    }
}
