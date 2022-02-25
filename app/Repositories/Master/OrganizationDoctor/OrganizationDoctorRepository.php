<?php

namespace App\Repositories\Master\OrganizationDoctor;

use App\Models\Master\OrganizationDoctor\OrganizationDoctor;
use App\Repositories\Repository;


class OrganizationDoctorRepository extends Repository
{
    public function __construct(OrganizationDoctor $organizationDoctor)
    {
        $this->model = $organizationDoctor;
    }
}
