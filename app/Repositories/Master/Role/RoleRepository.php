<?php

namespace App\Repositories\Master\Role;

use App\Models\Master\Role\Role;
use App\Models\Master\Role\RoleTranslation;
use App\Models\Master\Role\ViewRole;
use App\Repositories\Repository;

class RoleRepository extends Repository
{

    public function __construct(Role $role, RoleTranslation $roleTranslation, ViewRole $viewRole)
    {
        $this->model = $role;
        $this->modelTranslation = $roleTranslation;
        $this->modelView = $viewRole;
    }
}
