<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use App\Http\Requests\Master\ListRequest;
use App\Services\Master\Specialty\SpecialtyService;
use App\Http\Requests\Master\Specialty\SpecialtyIndexRequest;
use App\Http\Requests\Master\Specialty\SpecialtyStoreUpdateRequest;

class SpecialtyController extends Controller
{
    protected SpecialtyService $specialtyService;

    public function __construct(SpecialtyService $specialtyService)
    {
        $this->specialtyService = $specialtyService;
    }

    public function index(SpecialtyIndexRequest $specialtyIndexRequest)
    {
        return $this->specialtyService->indexSpecialty($specialtyIndexRequest->validated());
    }

    public function show($id)
    {
        return $this->specialtyService->showSpecialty($id);
    }

    public function store(SpecialtyStoreUpdateRequest $specialtyStoreUpdateRequest)
    {
        return $this->specialtyService->storeSpecialty($specialtyStoreUpdateRequest->validated());
    }

    public function update($id, SpecialtyStoreUpdateRequest $specialtyStoreUpdateRequest)
    {
        return $this->specialtyService->updateSpecialty($id, $specialtyStoreUpdateRequest->validated());
    }

    public function destroy($id)
    {
        return $this->specialtyService->softDelete($id);
    }

    public function list(ListRequest $listRequest)
    {
        return $this->specialtyService->listSpecialty($listRequest->validated());
    }
}
