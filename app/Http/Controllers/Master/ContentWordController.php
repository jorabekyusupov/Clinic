<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use App\Http\Requests\Master\ListRequest;
use App\Services\Master\ContentWord\ContentWordService;
use App\Http\Requests\Master\ContentWord\ContentWordIndexRequest;
use App\Http\Requests\Master\ContentWord\ContentWordGlobalRequest;
use App\Http\Requests\Master\ContentWord\ContentWordStoreUpdateRequest;

class ContentWordController extends Controller
{
    protected ContentWordService $contentWordService;

    public function __construct(ContentWordService $contentWordService)
    {
        $this->contentWordService = $contentWordService;
    }

    public function index(ContentWordIndexRequest $contentWordIndexRequest)
    {
        return $this->contentWordService->indexContentWord($contentWordIndexRequest->validated());
    }

    public function show($id)
    {
        return $this->contentWordService->showContentWord($id);
    }

    public function store(ContentWordStoreUpdateRequest $contentWordStoreUpdateRequest)
    {
        return $this->contentWordService->storeContentWord($contentWordStoreUpdateRequest->validated());
    }

    public function update($id, ContentWordStoreUpdateRequest $contentWordStoreUpdateRequest)
    {
        return $this->contentWordService->updateContentWord($id, $contentWordStoreUpdateRequest->validated());
    }

    public function destroy($id)
    {
        return $this->contentWordService->softDelete($id);
    }

    public function list(ListRequest $listRequest)
    {
        return $this->contentWordService->listContentWord($listRequest->validated());
    }

    public function global(ContentWordGlobalRequest $contentWordGlobalRequest)
    {
        return $this->contentWordService->globalContentWord($contentWordGlobalRequest->validated());
    }
}
