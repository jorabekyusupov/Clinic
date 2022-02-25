<?php

namespace App\Services\Master\Doctor;

use App\Services\MainService;
use App\Services\Master\Person\PersonService;
use App\Repositories\Master\Doctor\DoctorRepository;
use App\Services\Service;

class DoctorService extends Service
{
    protected PersonService $personService;
    protected MainService $mainService;

    public function __construct(
        PersonService    $personService,
        DoctorRepository $doctorRepository,
        MainService      $mainService
    )
    {
        $this->personService = $personService;
        $this->repository = $doctorRepository;
        $this->mainService = $mainService;
    }

    public function indexDoctor($data)
    {
        $search = $data['search'];
        $page = $data['page'] ?? 1;
        $rows = $data['rows'] ?? 1000;

        $doctors = $this->get()->with('person')
            ->with('default_picture');

        if (isset($search)) {
            $doctors->where('phones', 'ilike', '%' . $search . '%')
                ->oRwhereHas('person', function ($q) use ($search) {
                    $q->where('first_name', 'ilike', '%' . $search . '%');
                })->oRwhereHas('person', function ($q) use ($search) {
                    $q->where('last_name', 'ilike', '%' . $search . '%');
                })->oRwhereHas('person', function ($q) use ($search) {
                    $q->where('middle_name', 'ilike', '%' . $search . '%');
                });
        }

        return $doctors->orderBy('id')->paginate($rows, ['*'], 'page name', $page);
    }

    public function showDoctor($id, $data)
    {
        $language = $data['language'];
        $type = $data['object_type'];
        if ($type && $type == 'person') {
            $doctor = $this->get()->where('person_id', $id)
                ->with('person')
                ->with([
                    'specialties' => function ($query1) use ($language) {
                        $query1->where('language_code', $language)
                            ->with([
                                'specialtyType' => function ($query2) use ($language) {
                                    $query2->where('language_code', $language);
                                }
                            ]);
                    }
                ])->first();
        } elseif ($type && $type == 'doctor') {
            $doctor = $this->get()->where('id', $id)
                ->with('person')
                ->with([
                    'specialties' => function ($query1) use ($language) {
                        $query1->where('language_code', $language)
                            ->with([
                                'specialtyType' => function ($query2) use ($language) {
                                    $query2->where('language_code', $language);
                                }
                            ]);
                    }
                ])->first();
        } else {
            return response()->json('Object type error', 400);
        }
        if ($doctor) {
            return $doctor;
        } else {
            return response()->json('Not found', 404);
        }

    }

    public function storeDoctor($data)
    {
        try {
            $data['created_by'] = $this->mainService->auth::id();
            $doctor = $this->store($data);
            return response($doctor->id, 201);
        } catch (\Throwable $throwable) {
            info($throwable->getMessage());
            return response()->json('Not implemented', 501);
        }
    }

    public function updateDoctor($id, $data)
    {
        try {
            $data['updated_by'] = $this->mainService->auth::id();
            $doctor = $this->edit($id, $data);
            return response($doctor->id);
        } catch (\Throwable $throwable) {
            info($throwable->getMessage());
            return response()->json('Not found', 404);
        }
    }

    public function listDoctor($data)
    {
        $language = $data['language'];
        $originalEvent = $data['originalEvent'];
        $page = isset($originalEvent['page']) ? $originalEvent['page'] + 1 : 1;
        $rows = $originalEvent['rows'];
        $global_search = $originalEvent['globalsearch'] ?? null;

        $models = $this->get([
            'default_picture', 'contacts', 'workSchedules', 'person:id,first_name,last_name,middle_name'
        ])
            ->with([
                'specialties' => function ($query) use ($language) {
                    $query->select('name')->where('language_code', $language);
                }
            ])
            ->orderBy('id');

        if (isset($global_search)) {
            $models = $models->whereHas('person', function ($query) use ($global_search) {
                $query->where('first_name', 'ilike', '%' . $global_search . '%')
                    ->orWhere('last_name', 'ilike', '%' . $global_search . '%')
                    ->orWhere('middle_name', 'ilike', '%' . $global_search . '%');
            });
        }

        $models = $this->mainService->filterModels($models, $originalEvent);

        return $models->paginate($rows == '-1' ? 1000000 : $rows, ['*'], 'page name', $page);
    }


}
