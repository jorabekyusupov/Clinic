<?php

namespace App\Services\Master\Language;

use App\Repositories\Master\Language\LanguageRepository;
use App\Services\Service;
use Illuminate\Support\Facades\Auth;

class LanguageService extends Service
{
    protected $auth;

    public function __construct(LanguageRepository $languageRepository, Auth $auth)
    {
        $this->repository = $languageRepository;
        $this->auth = $auth;
    }
    public function indexLanguage()
    {
       return $this->get()->select('id', 'code', 'name')->where('is_active', 1)->get();
    }
    public function storeLanguage($data)
    {
        try {
            $data['created_by'] = $this->auth::id();
            $language = $this->store($data);
            return response()->json($language->id, 201);
        } catch (\Throwable $throwable) {
            info($throwable->getMessage());
            return response()->json('Not implemented', 501);
        }
    }
    public function updateLanguage($id, $data)
    {
        try {
             $data['updated_by'] = $this->auth::id();
            $language = $this->edit($id, $data);
            return response()->json($language->id);
        } catch (\Throwable $throwable) {
            info($throwable->getMessage());
            return response()->json('Not found', 404);
        }
    }
}
