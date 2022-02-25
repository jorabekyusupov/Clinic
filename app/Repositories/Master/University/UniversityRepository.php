<?php

namespace App\Repositories\Master\University;

use App\Models\Master\University\University;
use App\Models\Master\University\UniversityTranslation;
use App\Models\Master\University\ViewUniversity;
use App\Repositories\Repository;

class UniversityRepository extends Repository
{

    public function __construct(University $university, UniversityTranslation $universityTranslation, ViewUniversity $viewUniversity)
    {
        $this->model = $university;
        $this->modelTranslation = $universityTranslation;
        $this->modelView = $viewUniversity;
    }
}
