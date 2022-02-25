<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use App\Http\Requests\Master\ListRequest;
use App\Services\Master\University\UniversityService;
use App\Http\Requests\Master\University\UniversityIndexRequest;
use App\Http\Requests\Master\University\UniversityStoreUpdateRequest;

class UniversityController extends Controller
{
    protected UniversityService $universityService;

    public function __construct(UniversityService $universityService)
    {
        $this->universityService = $universityService;
    }

    public function index(UniversityIndexRequest $universityIndexRequest)
    {
        return $this->universityService->indexUniversity($universityIndexRequest->validated());
    }

    public function store(UniversityStoreUpdateRequest $universityStoreUpdateRequest)
    {
        return $this->universityService->storeUniversity($universityStoreUpdateRequest->validated());
    }

    public function show($id)
    {
        return $this->universityService->showUniversity($id);
    }

    public function update($id, UniversityStoreUpdateRequest $universityStoreUpdateRequest)
    {
        return $this->universityService->updateUniversity($id, $universityStoreUpdateRequest->validated());
    }

    public function list(ListRequest $listRequest)
    {
        return $this->universityService->listUniversity($listRequest->validated());
    }

    public function destroy($id)
    {
        return $this->universityService->softDelete($id);
    }
}
