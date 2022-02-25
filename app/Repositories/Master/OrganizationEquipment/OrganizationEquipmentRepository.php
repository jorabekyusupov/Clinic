<?php

namespace App\Repositories\Master\OrganizationEquipment;

use App\Models\Master\OrganizationEquipment\OrganizationEquipment;
use App\Models\Master\OrganizationEquipment\OrganizationEquipmentTranslation;
use App\Models\Master\OrganizationEquipment\ViewOrganizationEquipment;
use App\Repositories\Repository;

class OrganizationEquipmentRepository extends Repository
{

    public function __construct(OrganizationEquipment $organizationEquipment, OrganizationEquipmentTranslation $organizationEquipmentTranslation, ViewOrganizationEquipment $viewOrganizationEquipment)
    {
        $this->model = $organizationEquipment;
        $this->modelTranslation = $organizationEquipmentTranslation;
        $this->modelView = $viewOrganizationEquipment;
    }
}
