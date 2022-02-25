<?php

namespace App\Services\Master\User;

use App\Repositories\Master\User\PermissionUserRepository;
use App\Services\Service;

class PermissionUserService extends Service
{
    public function __construct(PermissionUserRepository $permissionUserRepository)
    {
        $this->repository = $permissionUserRepository;
    }
}
