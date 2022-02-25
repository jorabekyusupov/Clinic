<?php

namespace App\Repositories\Master\StudyType;

use App\Models\Master\StudyType\StudyType;
use App\Models\Master\StudyType\StudyTypeTranslation;
use App\Models\Master\StudyType\ViewStudyType;
use App\Repositories\Repository;

class StudyTypeRepository extends Repository
{

    public function __construct(StudyType $studyType, StudyTypeTranslation $studyTypeTranslation, ViewStudyType $viewStudyType)
    {
        $this->model = $studyType;
        $this->modelTranslation = $studyTypeTranslation;
        $this->modelView = $viewStudyType;
    }
}
