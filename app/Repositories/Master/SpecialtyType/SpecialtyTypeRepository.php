<?php

namespace App\Repositories\Master\SpecialtyType;

use App\Models\Master\SpecialtyType\SpecialtyType;
use App\Models\Master\SpecialtyType\SpecialtyTypeTranslation;
use App\Models\Master\SpecialtyType\ViewSpecialtyType;
use App\Repositories\Repository;

class SpecialtyTypeRepository extends Repository
{

    public function __construct(SpecialtyType $specialtyType, SpecialtyTypeTranslation $specialtyTypeTranslation, ViewSpecialtyType $viewSpecialtyType)
    {
        $this->model = $specialtyType;
        $this->modelTranslation = $specialtyTypeTranslation;
        $this->modelView = $viewSpecialtyType;
    }
}
