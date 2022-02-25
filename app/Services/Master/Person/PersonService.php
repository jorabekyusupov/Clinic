<?php

namespace App\Services\Master\Person;

use App\Services\MainService;
use App\Repositories\Master\Person\PersonRepository;
use App\Services\Service;

class PersonService extends Service
{

    protected MainService $mainService;

    function __construct(PersonRepository $personRepository, MainService $mainService)
    {
        $this->repository = $personRepository;
        $this->mainService = $mainService;
    }

    public function storePerson($data)
    {
        try {
            $data['created_by'] = $this->mainService->auth::id();
            $person = $this->store($data);
            return response()->json($person->id, 201);
        } catch (\Throwable $throwable) {
            info($throwable->getMessage());
            return response()->json('Not implemented', 501);
        }
    }

    public function updatePerson($id, $data)
    {
        try {
            $data['updated_by'] = $this->mainService->auth::id();
            $person = $this->edit($id, $data);
            return response()->json($person->id);
        } catch (\Throwable $throwable) {
            info($throwable->getMessage());
            return response()->json('Not found', 404);
        }
    }

    public function jshshirPerson($jshshir)
    {
        $person = $this->get()->where('jshshir', $jshshir)->first();
        if ($person) {
            return response()->json($person);
        } else {
            return response()->json('Not found', 404);
        }
    }

}
