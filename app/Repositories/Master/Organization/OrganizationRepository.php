<?php

namespace App\Repositories\Master\Organization;

use App\Models\Master\Organization\Organization;
use App\Models\Master\Organization\OrganizationTranslation;
use App\Models\Master\Organization\ViewOrganization;
use App\Repositories\Repository;

class OrganizationRepository extends Repository
{

    public function __construct(Organization $organization, OrganizationTranslation $organizationTranslation, ViewOrganization $viewOrganization)
    {
        $this->model = $organization;
        $this->modelTranslation = $organizationTranslation;
        $this->modelView = $viewOrganization;
    }
}
