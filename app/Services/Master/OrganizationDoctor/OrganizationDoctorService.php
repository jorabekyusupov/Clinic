<?php

namespace App\Services\Master\OrganizationDoctor;


use App\Repositories\Master\OrganizationDoctor\OrganizationDoctorRepository;
use App\Services\MainService;
use App\Services\Service;

class OrganizationDoctorService extends Service
{
    protected MainService $mainService;

    public function __construct(OrganizationDoctorRepository $organizationDoctorRepository, MainService $mainService)
    {
        $this->repository = $organizationDoctorRepository;
        $this->mainService = $mainService;
    }

    public function indexOrganizationDoctor($data)
    {
        $organization_id = $data['organization_id'];

        return $this->get()->select('id', 'organization_id', 'doctor_id')->where('organization_id',
            $organization_id)
            ->with([
                'doctor' => function ($query) {
                    $query->select('id', 'status',
                        'person_id')->with('person:id,first_name,last_name,middle_name,born_date,jshshir,gender');
                }
            ])->get();
    }

    public function storeOrganizationDoctor($data)
    {
        try {
            $data['created_by'] = $this->mainService->auth::id();
            $result = $this->store($data);
            return response()->json($result->id, 201);
        } catch (\Throwable $throwable) {
            info($throwable->getMessage());
            return response()->json('Not implemented', 501);
        }
    }

    public function updateOrganizationDoctor($id, $data)
    {
        try {
            $data['updated_by'] = $this->mainService->auth::id();
            $result = $this->edit($id, $data);
            return response()->json($result->id);
        } catch (\Throwable $throwable) {
            info($throwable->getMessage());
            return response()->json('Not found', 404);
        }
    }

    public function toggleOrganizationDoctor($data)
    {
        $organization_id = $data['organization_id'];
        $doctor_id = $data['doctor_id'];
        $type = $data['type'];

        if ($type) {
            $data['created_by'] = $this->mainService->auth::id();
            $this->store($data);
        } else {
            $this->get()->where('organization_id', $organization_id)
                ->where('doctor_id', $doctor_id)->delete();
        }

        return response()->json('Successfully');
    }


}
