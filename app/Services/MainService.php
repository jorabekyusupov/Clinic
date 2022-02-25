<?php

namespace App\Services;

use App\Models\Master\Language\Language;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Auth;
use App\Services\Master\Language\LanguageService;

class MainService
{
    public $auth, $translation_relation = 'translations.language:id,code,name', $languageService;

    public function __construct(LanguageService $languageService, Auth $auth)
    {
        $this->languageService = $languageService;
        $this->auth = $auth;
    }

    public function list($data, $models, $columns)
    {
        $language = $data['language'];
        $originalEvent = $data['originalEvent'];
        $page = isset($originalEvent['page']) ? $originalEvent['page'] + 1 : 1;
        $rows = $originalEvent['rows'] ?? 10000;
        $global_search = $originalEvent['globalsearch'] ?? null;

        $this->filterModels($models, $originalEvent);
        if (isset($originalEvent['globalsearch'])) {
            $columns = $columns;
            $models = $this->globalSearch($models, $columns, $global_search);
        }
        return $models->orderBy('id')->paginate($rows, ['*'], 'page name', $page);
    }

    public function filterModels($models, $originalEvent)
    {
        $multiSortMeta = $originalEvent['multiSortMeta'];
        if (isset($originalEvent['filters'])) {
            foreach ($originalEvent['filters'] as $key => $filter) {
                if (isset($filter['value'])) {
                    if ($filter['filter_type'] == 'like') {
                        $models->where($key, 'ilike', '%' . $filter['value'] . '%');
                    }
                    if ($filter['filter_type'] == 'date' || $filter['filter_type'] == 'equal') {
                        $models->where($key, $filter['value']);
                    }
                    if ($filter['filter_type'] == 'select') {
                        $models->where($filter['matchMode'], $filter['value']);
                    }
                    if ($filter['filter_type'] == 'date_range') {
                        $end_date = $filter['value'][1] ?? date(
                            'Y-m-d H:i:s',
                            strtotime($filter['value'][0] . ' +1 day')
                        );
                        $models->whereBetween($key, [$filter['value'][0], $end_date]);
                    }
                    if ($filter['filter_type'] == 'relation') {
                        $models->whereHas($key, function ($q) use ($filter) {
                            foreach ($filter['matchMode'] as $key_mm => $matchMode) {
                                $key_mm == 0 ?
                                    $q->where($matchMode, 'ilike', '%' . $filter['value'] . '%') :
                                    $q->orWhere($matchMode, 'ilike', '%' . $filter['value'] . '%');
                            }
                        });
                    }
                }
            }
        }

        if (isset($multiSortMeta)) {
            foreach ($multiSortMeta as $sort) {
                $order_type = $sort['order'] == 1 ? "ASC" : "DESC";
                $models->orderBy($sort['field'], $order_type);
            }
        } else {
            $models->orderBy('id', 'ASC');
        }

        return $models;
    }

    public function globalSearch($models, $columns, $searched_query)
    {
        $models->where(function ($query) use ($columns, $searched_query) {
            foreach ($columns as $key => $column) {
                if ($key == 0)
                    $query->where($column, 'ilike', '%' . $searched_query . '%');
                else
                    $query->orWhere($column, 'ilike', '%' . $searched_query . '%');
            }
        });
        return $models;
    }

    public function showWithTranslations($model, $data)
    {
        $languages = $this->languageService->get()->select('id', 'code', 'name')->where('is_active', 1)->get();

        $not_languages = $languages->whereNotIn('code', $model->translations->pluck('language_code'));
        foreach ($not_languages as $not_language) {
            $data['language'] = $not_language;
            $data['language_code'] = $not_language->code;
            $model->translations->push($data);
        }
        return $model;
    }

    public function edit($id, $model, $model_translation)
    {
        $languages = Language::where('is_active', 1)->get();
        $not_languages = $languages->whereNotIn('code', $model->translations->pluck('language_code'));

        foreach ($not_languages as $not_language) {
            $new_lang = new $model_translation;
            $new_lang->id = 0;
            $new_lang->permission_id = $id;
            $new_lang->language_code = $not_language->code;
            $new_lang->language = $not_language;
            $new_lang->display_name = '';
            $new_lang->description = '';
            $model->translations->push($new_lang);
        }
        return $model;
    }

    public function softDelete($model)
    {
        $model->deleted_by = $this->auth::id();
        $model->save();
        $model->delete();
    }
}
