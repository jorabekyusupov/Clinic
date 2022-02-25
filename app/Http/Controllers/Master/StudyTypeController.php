<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use App\Http\Requests\Master\ListRequest;
use App\Services\Master\StudyType\StudyTypeService;
use App\Http\Requests\Master\StudyType\UniversityIndexRequest;
use App\Http\Requests\Master\StudyType\UniversityStoreUpdateRequest;

class StudyTypeController extends Controller
{
    protected StudyTypeService $studyTypeService;

    public function __construct(StudyTypeService $studyTypeService)
    {
        $this->studyTypeService = $studyTypeService;
    }

    public function index(UniversityIndexRequest $studyTypeIndexRequest)
    {
        return $this->studyTypeService
            ->indexStudyType($studyTypeIndexRequest->validated());
    }

    public function store(UniversityStoreUpdateRequest $studyTypeStoreUpdateRequest)
    {
        return $this->studyTypeService
            ->storeStudyType($studyTypeStoreUpdateRequest->validated());
    }

    public function show($id)
    {
        return $this->studyTypeService->showStudyType($id);
    }

    public function update($id, UniversityStoreUpdateRequest $studyTypeStoreUpdateRequest)
    {
        return $this->studyTypeService
            ->updateStudyType($id, $studyTypeStoreUpdateRequest->validated());
    }

    public function list(ListRequest $listRequest)
    {
        return $this->studyTypeService
            ->listStudyType($listRequest->validated());
    }

    public function destroy($id)
    {
        return $this->studyTypeService->softDelete($id);
    }
}
