<?php

namespace App\Repositories\Master\OrganizationServiceSchedule;

use App\Models\Master\OrganizationServiceSchedule\OrganizationServiceSchedule;
use App\Repositories\Repository;

class OrganizationServiceScheduleRepository extends Repository
{
    public function __construct(OrganizationServiceSchedule $organizationServiceSchedule)
    {
        $this->model = $organizationServiceSchedule;
    }
}
