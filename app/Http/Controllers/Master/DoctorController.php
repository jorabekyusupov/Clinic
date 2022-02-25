<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use App\Services\MainService;
use App\Http\Requests\Master\ListRequest;
use App\Services\Master\Doctor\DoctorService;
use App\Http\Requests\Master\Doctor\DoctorShowRequest;
use App\Http\Requests\Master\Doctor\DoctorIndexRequest;
use App\Http\Requests\Master\Doctor\DoctorStoreUpdateRequest;

class DoctorController extends Controller
{
    protected DoctorService $doctorService;
    protected MainService $mainService;

    public function __construct(DoctorService $doctorService, MainService $mainService)
    {
        $this->doctorService = $doctorService;
        $this->mainService = $mainService;
    }

    public function index(DoctorIndexRequest $doctorIndexRequest)
    {
        return $this->doctorService->indexDoctor($doctorIndexRequest->validated());
    }

    public function show($id, DoctorShowRequest $doctorShowRequest)
    {
        return $this->doctorService->showDoctor($id, $doctorShowRequest->validated());
    }

    public function store(DoctorStoreUpdateRequest $doctorStoreUpdateRequest)
    {
        return $this->doctorService->storeDoctor($doctorStoreUpdateRequest->validated());
    }

    public function update($id, DoctorStoreUpdateRequest $doctorStoreUpdateRequest)
    {
        return $this->doctorService->updateDoctor($id, $doctorStoreUpdateRequest->validated());
    }

    public function destroy($id)
    {
        return $this->doctorService->softDelete($id);
    }

    public function list(ListRequest $listRequest)
    {
        return $this->doctorService->listDoctor($listRequest->validated());
    }
}
