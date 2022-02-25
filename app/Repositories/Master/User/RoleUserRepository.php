<?php

namespace App\Repositories\Master\User;

use App\Models\Master\RoleUser\RoleUser;
use App\Repositories\Repository;

class RoleUserRepository extends Repository
{
    public function __construct(RoleUser $roleUser)
    {
        $this->model = $roleUser;
    }
}
