<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use App\Services\Master\DoctorSpecialty\DoctorSpecialtyService;
use App\Http\Requests\Master\DoctorSpecialty\DoctorSpecialtyIndexRequest;
use App\Http\Requests\Master\DoctorSpecialty\DoctorSpecialtyToggleRequest;
use App\Http\Requests\Master\DoctorSpecialty\DoctorSpecialtyStoreUpdateRequest;

class DoctorSpecialtyController extends Controller
{
    protected DoctorSpecialtyService $doctorSpecialtyService;

    public function __construct(DoctorSpecialtyService $doctorSpecialtyService)
    {
        $this->doctorSpecialtyService = $doctorSpecialtyService;
    }

    public function index(DoctorSpecialtyIndexRequest $doctorSpecialtyIndexRequest)
    {
        return $this->doctorSpecialtyService->indexDoctorSpecialty($doctorSpecialtyIndexRequest->validated());
    }

    public function store(DoctorSpecialtyStoreUpdateRequest $doctorSpecialtyStoreUpdateRequest)
    {
        return $this->doctorSpecialtyService->storeDoctorSpecialty($doctorSpecialtyStoreUpdateRequest->validated());
    }

    public function update($id, DoctorSpecialtyStoreUpdateRequest $doctorSpecialtyStoreUpdateRequest)
    {
        return $this->doctorSpecialtyService->updateDoctorSpecialty($id,
            $doctorSpecialtyStoreUpdateRequest->validated());
    }

    protected function toggle(DoctorSpecialtyToggleRequest $doctorSpecialtyToggleRequest)
    {
        return $this->doctorSpecialtyService->toggleDoctorSpecialty($doctorSpecialtyToggleRequest->validated());
    }

    public function destroy($id)
    {
        return $this->doctorSpecialtyService->delete($id);
    }
}
