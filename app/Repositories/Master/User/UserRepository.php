<?php

namespace App\Repositories\Master\User;

use App\Models\Master\User\User;
use App\Repositories\Repository;

class UserRepository extends Repository
{
    public function __construct(User $user)
    {
        $this->model = $user;
    }
}
