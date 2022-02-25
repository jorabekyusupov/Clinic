<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use App\Services\Master\Person\PersonService;
use App\Http\Requests\Master\Person\PersonStoreUpdateRequest;

class PersonController extends Controller
{
    protected PersonService $personService;

    public function __construct(PersonService $personService)
    {
        $this->personService = $personService;
    }

    public function show($id)
    {
        $person = $this->personService->show($id);
        if ($person) {
            return $person;
        } else {
            return response()->json('Not found', 404);
        }
    }

    public function store(PersonStoreUpdateRequest $personStoreUpdateRequest)
    {
        return $this->personService->storePerson($personStoreUpdateRequest->validated());
    }

    public function update($id, PersonStoreUpdateRequest $personStoreUpdateRequest)
    {
        return $this->personService->updatePerson($id, $personStoreUpdateRequest->validated());
    }

    public function destroy($id)
    {
        return $this->personService->softDelete($id);
    }

    public function jshshir($jshshir)
    {
        return $this->personService->jshshirPerson($jshshir);
    }
}
