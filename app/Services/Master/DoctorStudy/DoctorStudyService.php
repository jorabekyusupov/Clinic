<?php

namespace App\Services\Master\DoctorStudy;

use App\Services\MainService;
use App\Repositories\Master\DoctorStudy\DoctorStudyRepository;
use App\Services\Service;

class DoctorStudyService extends Service
{
    private MainService $mainService;

    public function __construct(MainService $mainService, DoctorStudyRepository $doctorStudyRepository)
    {
        $this->mainService = $mainService;
        $this->repository = $doctorStudyRepository;
    }

    private function relations($language): array
    {
        return [
            'doctorStudyType' => function ($query) use ($language) {
                $query->where('language_code', $language);
            },
            'doctorUniversity' => function ($query) use ($language) {
                $query->where('language_code', $language);
            },
            'doctorStudyDegree' => function ($query) use ($language) {
                $query->where('language_code', $language);
            },
            'doctorSpecialty' => function ($query) use ($language) {
                $query->where('language_code', $language);
            }
        ];
    }

    public function storeDoctorStudy($data)
    {
        try {
            $data['created_by'] = $this->mainService->auth::id();
            $doctorStudy = $this->store($data);
            return response()->json($doctorStudy->id, 201);
        } catch (\Throwable $throwable) {
            info($throwable->getMessage());
            return response()->json('Not implemented', 501);
        }
    }

    public function indexDoctorStudy($data)
    {
        $language = $data['language'];
        $doctor_id = $data['doctor_id'];
        $doctorStudy = $this->repository->query()
            ->where('doctor_id', $doctor_id)
            ->with($this->relations($language))
            ->latest();
        return $doctorStudy->get();
    }

    public function showDoctorStudy($id, $data)
    {
        $doctor_study = $this->show($id, $this->relations($data['language']));
        if ($doctor_study) {
            return $doctor_study;
        } else {
            return response()->json('Not found', 404);
        }
    }

    public function updateDoctorStudy($id, $data)
    {
        try {
            $data['updated_by'] = $this->mainService->auth::id();
            $doctorStudy = $this->edit($id, $data);
            return response()->json($doctorStudy->id);
        } catch (\Throwable $throwable) {
            info($throwable->getMessage());
            return response()->json('Not found', 404);
        }
    }
}
