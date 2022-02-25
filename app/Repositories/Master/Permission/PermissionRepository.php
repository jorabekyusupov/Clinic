<?php

namespace App\Repositories\Master\Permission;

use App\Models\Master\Permission\Permission;
use App\Models\Master\Permission\PermissionTranslation;
use App\Models\Master\Permission\ViewPermission;
use App\Repositories\Repository;

class PermissionRepository extends Repository
{

    public function __construct(Permission $permission, PermissionTranslation $permissionTranslation, ViewPermission $viewPermission)
    {
        $this->model = $permission;
        $this->modelTranslation = $permissionTranslation;
        $this->modelView = $viewPermission;
    }
}
