<?php

namespace App\Repositories\Master\User;

use App\Models\Master\PermissionUser\PermissionUser;
use App\Repositories\Repository;

class PermissionUserRepository extends Repository
{
    public function __construct(PermissionUser $permissionUser)
    {
        $this->model = $permissionUser;
    }
}
