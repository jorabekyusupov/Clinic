<?php

namespace App\Repositories\Master\Doctor;

use App\Models\Master\Doctor\Doctor;
use App\Models\Master\Doctor\ViewDoctor;
use App\Repositories\Repository;

class DoctorRepository extends Repository
{

    public function __construct(Doctor $doctor, ViewDoctor $viewDoctor)
    {
        $this->model = $doctor;
        $this->modelView = $viewDoctor;
    }
}
