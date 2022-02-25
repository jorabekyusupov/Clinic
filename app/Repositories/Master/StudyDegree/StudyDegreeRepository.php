<?php

namespace App\Repositories\Master\StudyDegree;

use App\Models\Master\StudyDegree\StudyDegree;
use App\Models\Master\StudyDegree\StudyDegreeTranslation;
use App\Models\Master\StudyDegree\ViewStudyDegree;
use App\Repositories\Repository;

class StudyDegreeRepository extends Repository
{

    public function __construct(StudyDegree $studyDegree, StudyDegreeTranslation $studyDegreeTranslation, ViewStudyDegree $viewStudyDegree)
    {
        $this->model = $studyDegree;
        $this->modelTranslation = $studyDegreeTranslation;
        $this->modelView = $viewStudyDegree;
    }
}
