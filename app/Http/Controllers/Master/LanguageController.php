<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use App\Services\Master\Language\LanguageService;
use App\Http\Requests\Master\Language\LanguageStoreUpdateRequest;

class LanguageController extends Controller
{
    protected LanguageService $languageService;

    public function __construct(LanguageService $languageService)
    {
        $this->languageService = $languageService;
    }

    public function index()
    {
        return $this->languageService->indexLanguage();
    }

    public function show($id)
    {
        $language = $this->languageService->show($id);
        if ($language) {
            return $language;
        } else {
            return response()->json('Not found', 404);
        }

    }

    public function update($id, LanguageStoreUpdateRequest $languageStoreUpdateRequest)
    {
        return $this->languageService->updateLanguage($id, $languageStoreUpdateRequest->validated());
    }

    public function store(LanguageStoreUpdateRequest $languageStoreUpdateRequest)
    {
        return $this->languageService->storeLanguage($languageStoreUpdateRequest->validated());
    }

    public function destroy($id)
    {
        return $this->languageService->delete($id);
    }
}
