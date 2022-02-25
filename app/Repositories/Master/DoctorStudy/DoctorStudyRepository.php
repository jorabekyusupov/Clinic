<?php

namespace App\Repositories\Master\DoctorStudy;

use App\Models\Master\DoctorStudy\DoctorStudy;
use App\Repositories\Repository;

class DoctorStudyRepository extends Repository
{
    public function __construct(DoctorStudy $doctorStudy)
    {
        $this->model = $doctorStudy;
    }
}
