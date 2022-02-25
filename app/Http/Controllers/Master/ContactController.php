<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use App\Services\Master\Contact\ContactService;
use App\Http\Requests\Master\Contact\ContactIndexRequest;
use App\Http\Requests\Master\Contact\ContactStoreUpdateRequest;

class ContactController extends Controller
{
    protected ContactService $contactService;

    public function __construct(ContactService $contactService)
    {
        $this->contactService = $contactService;
    }

    public function index(ContactIndexRequest $contactIndexRequest)
    {
        return $this->contactService->indexContact($contactIndexRequest->validated());
    }

    public function update(ContactStoreUpdateRequest $contactStoreUpdateRequest)
    {
        return $this->contactService->updateContact($contactStoreUpdateRequest->validated());
    }
}
