<?php

namespace App\Services\Master\DoctorSpecialty;

use App\Services\MainService;
use App\Repositories\Master\DoctorSpecialty\DoctorSpecialtyRepository;
use App\Services\Service;

class DoctorSpecialtyService extends Service
{
    protected MainService $mainService;

    public function __construct(DoctorSpecialtyRepository $doctorSpecialtyRepository, MainService $mainService)
    {
        $this->mainService = $mainService;
        $this->repository = $doctorSpecialtyRepository;
    }

    public function indexDoctorSpecialty($data)
    {
        $doctor_id = $data['doctor_id'];
        $language = $data['language'];
        return $this->get()->where('doctor_id', $doctor_id)
            ->with([
                'specialty' => function ($query) use ($language) {
                    $query->where('language_code', $language);
                }
            ])
            ->get();
    }

    public function storeDoctorSpecialty($data)
    {
        try {
            $data['created_by'] = $this->mainService->auth::id();
            $DoctorSpecialty = $this->store($data);
            return response()->json($DoctorSpecialty->id, 201);
        } catch (\Throwable $throwable) {
            info($throwable->getMessage());
            return response()->json($throwable->getMessage(), 500);
        }
    }

    public function updateDoctorSpecialty($id, $data)
    {
        try {
            $data['updated_by'] = $this->mainService->auth::id();
            $DoctorSpecialty = $this->edit($id, $data);
            return response()->json($DoctorSpecialty->id);
        } catch (\Throwable $throwable) {
            info($throwable->getMessage());
            return response()->json('Not found', 404);
        }
    }

    public function toggleDoctorSpecialty($data)
    {
        $doctor_id = $data['doctor_id'];
        $specialty_id = $data['specialty_id'];
        $type = $data['type'];
        $data['created_by'] = $this->mainService->auth::id();
        if ($type) {
            $model = $this->store($data);
        } else {
            $this->get()->where('specialty_id', $specialty_id)->where('doctor_id', $doctor_id)->delete();
        }
        return response()->json('Successfully saved');
    }

}
