<?php

namespace App\Services\Master\Permission;

use App\Services\MainService;
use App\Repositories\Master\Permission\PermissionRepository;
use App\Services\Service;

class PermissionService extends Service
{
    protected MainService $mainService;

    public function __construct(
        MainService              $mainService,
        PermissionRepository     $permissionRepository
    )
    {
        $this->mainService = $mainService;
        $this->repository = $permissionRepository;
    }

    public function indexPermission($data)
    {
        $language = $data['language'];
        $search = $data['search'] ?? null;
        (int)$role_id = $data['role_id'] ?? null;
        (int)$not_in_role = $data['not_in_role'] ?? null;
        $page = $data['page'] ?? 1;
        $rows = $data['rows'] ?? 1000;

        $permissions = $this->getView()
            ->where('language_code', $language)->latest();

        if (isset($search)) {
            $permissions->where(function ($q) use ($search) {
                $q->where('name', 'ilike', '%' . $search . '%')
                    ->orWhere('display_name', 'ilike', '%' . $search . '%')
                    ->orWhere('description', 'ilike', '%' . $search . '%');
            });
        }

        if (isset($role_id)) {
            if (!$not_in_role) {
                $permissions->whereHas('role', function ($q) use ($role_id) {
                    $q->where('role_id', $role_id);
                });
            }
            if ($not_in_role) {
                $permissions->whereDoesntHave('role', function ($q) use ($role_id) {
                    $q->where('role_id', $role_id);
                });
            }
        }
        return $permissions->paginate($rows, ['*'], 'page name', $page);
    }

    public function showPermission($id)
    {
        $model = $this->show($id, [$this->mainService->translation_relation]);
        if ($model) {

            $data = [
                'permission_id' => $id,
                'display_name' => '',
                'description' => '',
            ];
            return $this->mainService->showWithTranslations($model, $data);
        } else {
            return response()->json('Not found', 404);
        }
    }

    public function storePermission($data)
    {
        try {
            $data['created_by'] = $this->mainService->auth::id();
            $permission = $this->store($data);
            $this->storeTranslation($permission->id, $data['translations'], 'permission_id');
            return response()->json($permission->id, 201);
        } catch (\Throwable $throwable) {
            info($throwable->getMessage());
            return response()->json('Not implemented', 501);
        }
    }

    public function updatePermission($id, $data)
    {
        try {

            $data['updated_by'] = $this->mainService->auth::id();
            $permission = $this->edit($id, $data);
            $this->editTranslation($id, $data['translations'], 'permission_id');
            return response()->json($permission->id);
        } catch (\Throwable $throwable) {
            info($throwable->getMessage());
            return response()->json('Not found', 404);
        }
    }

    public function listPermission($data)
    {
        $models = $this->getView()->where('language_code', $data['language'])->latest();
        return $this->mainService->list($data, $models, ['name', 'display_name', 'description']);
    }
}
