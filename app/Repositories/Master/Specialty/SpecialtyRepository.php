<?php

namespace App\Repositories\Master\Specialty;

use App\Models\Master\Specialty\Specialty;
use App\Models\Master\Specialty\SpecialtyTranslation;
use App\Models\Master\Specialty\ViewSpecialty;
use App\Repositories\Repository;

class SpecialtyRepository extends Repository{


    public function __construct(Specialty $specialty, SpecialtyTranslation $specialtyTranslation, ViewSpecialty $viewSpecialty)
    {
        $this->model = $specialty;
        $this->modelTranslation = $specialtyTranslation;
        $this->modelView = $viewSpecialty;
    }
}
