<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use App\Http\Requests\Master\ListRequest;
use App\Services\Master\StudyDegree\StudyDegreeService;
use App\Http\Requests\Master\StudyDegree\StudyDegreeIndexRequest;
use App\Http\Requests\Master\StudyDegree\StudyDegreeStoreUpdateRequest;

class StudyDegreeController extends Controller
{
    protected StudyDegreeService $studyDegreeService;

    public function __construct(StudyDegreeService $studyDegreeService)
    {
        $this->studyDegreeService = $studyDegreeService;
    }

    public function index(StudyDegreeIndexRequest $studyDegreeIndexRequest)
    {
        return $this->studyDegreeService
            ->indexStudyDegree($studyDegreeIndexRequest->validated());
    }

    public function store(StudyDegreeStoreUpdateRequest $studyDegreeStoreUpdateRequest)
    {
        return $this->studyDegreeService
            ->storeStudyDegree($studyDegreeStoreUpdateRequest->validated());
    }

    public function show($id)
    {
        return $this->studyDegreeService->showStudyDegree($id);
    }

    public function update($id, StudyDegreeStoreUpdateRequest $studyDegreeStoreUpdateRequest)
    {
        return $this->studyDegreeService
            ->updateStudyDegree($id, $studyDegreeStoreUpdateRequest->validated());
    }

    public function list(ListRequest $listRequest)
    {
        return $this->studyDegreeService
            ->listStudyDegree($listRequest->validated());
    }

    public function destroy($id)
    {
        return $this->studyDegreeService->softDelete($id);
    }
}
