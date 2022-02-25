<?php

namespace App\Repositories\Master\OrganizationType;

use App\Models\Master\OrganizationType\OrganizationType;
use App\Models\Master\OrganizationType\OrganizationTypeTranslation;
use App\Models\Master\OrganizationType\ViewOrganizationType;
use App\Repositories\Repository;

class OrganizationTypeRepository extends Repository
{

    public function __construct(OrganizationType $organizationType, OrganizationTypeTranslation $organizationTypeTranslation, ViewOrganizationType $viewOrganizationType)
    {
        $this->model = $organizationType;
        $this->modelTranslation = $organizationTypeTranslation;
        $this->modelView = $viewOrganizationType;
    }
}
