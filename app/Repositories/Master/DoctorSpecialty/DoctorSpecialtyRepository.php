<?php

namespace App\Repositories\Master\DoctorSpecialty;

use App\Models\Master\DoctorSpecialty\DoctorSpecialty;
use App\Repositories\Repository;

class DoctorSpecialtyRepository extends Repository
{
    public function __construct(DoctorSpecialty $doctorSpecialty)
    {
        $this->model = $doctorSpecialty;
    }
}
