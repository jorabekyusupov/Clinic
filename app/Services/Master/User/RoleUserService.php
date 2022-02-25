<?php

namespace App\Services\Master\User;

use App\Repositories\Master\User\RoleUserRepository;
use App\Services\Service;

class RoleUserService extends Service
{
    public function __construct(RoleUserRepository $roleUserRepository)
    {
        $this->repository = $roleUserRepository;
    }
}
