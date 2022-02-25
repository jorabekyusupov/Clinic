<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use App\Services\Master\DoctorStudy\DoctorStudyService;
use App\Http\Requests\Master\DoctorStudy\DoctorStudyShowRequest;
use App\Http\Requests\Master\DoctorStudy\DoctorStudyIndexRequest;
use App\Http\Requests\Master\DoctorStudy\DoctorStudyUpdateRequest;

class DoctorStudyController extends Controller
{
    protected DoctorStudyService $doctorStudyService;

    public function __construct(DoctorStudyService $doctorStudyService)
    {
        $this->doctorStudyService = $doctorStudyService;
    }

    public function store(DoctorStudyUpdateRequest $doctorStudyUpdateRequest)
    {
        return $this->doctorStudyService->storeDoctorStudy($doctorStudyUpdateRequest->validated());
    }

    public function index(DoctorStudyIndexRequest $doctorStudyIndexRequest)
    {
        return $this->doctorStudyService->indexDoctorStudy($doctorStudyIndexRequest->validated());
    }

    public function show($id, DoctorStudyShowRequest $doctorStudyShowRequest)
    {
        return $this->doctorStudyService->showDoctorStudy($id, $doctorStudyShowRequest->validated());
    }

    public function update($id, DoctorStudyUpdateRequest $doctorStudyUpdateRequest)
    {
        return $this->doctorStudyService->updateDoctorStudy($id, $doctorStudyUpdateRequest->validated());
    }

    public function destroy($id)
    {
        return $this->doctorStudyService->softDelete($id);
    }
}
