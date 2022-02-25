<?php

namespace App\Services\Master\ContentWord;


use App\Repositories\Master\ContentWord\ContentWordRepository;
use App\Services\MainService;
use App\Services\Service;

class ContentWordService extends Service
{
    protected MainService $mainService;

    public function __construct(
        MainService               $mainService,
        ContentWordRepository     $contentWordRepository
    ) {
        $this->mainService = $mainService;
        $this->repository = $contentWordRepository;
    }

    public function indexContentWord($data)
    {
        $language = $data['language'];
        $search = $data['search'];
        $model = $this->getView()->whereNull('deleted_at')
            ->where('word', 'ilike', '%' . $search . '%')
            ->where('language_code', $language)
            ->orderBy('id')
            ->get();
        return $model;
    }

    public function showContentWord($id)
    {
        $model = $this->show($id, [$this->mainService->translation_relation]);
        if ($model) {
            $data = [
                'content_word_id' => $id,
                'translation' => ''
            ];
            $this->mainService->showWithTranslations($model, $data);
            return response()->json($model);
        } else {
            return response()->json('Not found', 404);
        }
    }

    public function storeContentWord($data)
    {
        try {
            $data['created_by'] = $this->mainService->auth::id();
            $content_word = $this->store($data);
            $this->storeTranslation($content_word->id, $data['translations'], 'content_word_id');
            return response()->json($content_word->id, 201);
        } catch (\Throwable $throwable) {
            info($throwable->getMessage());
            return response()->json('Not implemented', 501);
        }
    }

    public function updateContentWord($id, $data)
    {
        try {
            $data['updated_by'] = $this->mainService->auth::id();
            $content_word = $this->edit($id, $data);
            $this->editTranslation($id, $data['translations'], 'content_word_id');
            return response()->json($content_word->id);
        } catch (\Throwable $throwable) {
            info($throwable->getMessage());
            return response()->json('Not found', 404);
        }
    }

    public function listContentWord($data)
    {
        $models = $this->getView()->whereNull('deleted_at')->where('language_code', $data['language'])->orderBy('id');
        return $this->mainService->list($data, $models, ['word', 'translation']);
    }

    public function globalContentWord($data)
    {
        $language = $data['language'];
        $content_words = $this->getView()->whereNull('deleted_at')
            ->where('language_code', $language)
            ->orderBy('id')
            ->get();
        $content_word = array();
        foreach ($content_words as $value) {
            $content_word[$value->word] = isset($value->translation) ? $value->translation : '';
        }
        return json_encode($content_word);
    }
}
