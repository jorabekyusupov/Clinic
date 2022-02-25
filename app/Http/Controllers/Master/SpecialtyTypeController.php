<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use App\Http\Requests\Master\ListRequest;
use App\Services\Master\SpecialtyType\SpecialtyTypeService;
use App\Http\Requests\Master\SpecialtyType\SpecialtyTypeIndexRequest;
use App\Http\Requests\Master\SpecialtyType\SpecialtyTypeStoreUpdateRequest;


class SpecialtyTypeController extends Controller
{
    protected SpecialtyTypeService $specialtyTypeService;

    public function __construct(SpecialtyTypeService $specialtyTypeService)
    {
        $this->specialtyTypeService = $specialtyTypeService;
    }

    public function index(SpecialtyTypeIndexRequest $specialtyTypeIndexRequest)
    {
        return $this->specialtyTypeService->indexSpecialtyType($specialtyTypeIndexRequest->validated());
    }

    public function show($id)
    {
        return $this->specialtyTypeService->showSpecialtyType($id);
    }

    public function store(SpecialtyTypeStoreUpdateRequest $specialtyTypeStoreUpdateRequest)
    {
        return $this->specialtyTypeService->storeSpecialtyType($specialtyTypeStoreUpdateRequest->validated());
    }

    public function update($id, SpecialtyTypeStoreUpdateRequest $specialtyTypeStoreUpdateRequest)
    {
        return $this->specialtyTypeService->updateSpecialtyType($id, $specialtyTypeStoreUpdateRequest->validated());
    }

    public function destroy($id)
    {
        return $this->specialtyTypeService->delete($id);
    }

    public function list(ListRequest $listRequest)
    {
        return $this->specialtyTypeService->listSpecialtyType($listRequest->validated());
    }
}
