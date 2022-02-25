<?php

namespace App\Repositories\Master\OrganizationService;

use App\Models\Master\OrganizationService\OrganizationService;
use App\Repositories\Repository;

class OrganizationServiceRepository extends Repository {

    public function __construct(OrganizationService $organizationService)
    {
        $this->model = $organizationService;
    }
}
