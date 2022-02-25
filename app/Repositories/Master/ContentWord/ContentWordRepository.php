<?php

namespace App\Repositories\Master\ContentWord;

use App\Models\Master\ContentWord\ContentWord;
use App\Models\Master\ContentWord\ContentWordTranslation;
use App\Models\Master\ContentWord\ViewContentWord;
use App\Repositories\Repository;


class ContentWordRepository extends Repository{


    public function __construct(ContentWord $contentWord, ContentWordTranslation $contentWordTranslation, ViewContentWord $viewContentWord)
    {
        $this->model = $contentWord;
        $this->modelTranslation = $contentWordTranslation;
        $this->modelView = $viewContentWord;
    }
}
