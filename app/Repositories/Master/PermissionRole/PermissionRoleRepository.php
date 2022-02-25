<?php

namespace App\Repositories\Master\PermissionRole;

use App\Models\Master\PermissionRole\PermissionRole;
use App\Repositories\Repository;

class PermissionRoleRepository extends Repository
{
    public function __construct(PermissionRole $permissionRole)
    {
        $this->model = $permissionRole;
    }
}
