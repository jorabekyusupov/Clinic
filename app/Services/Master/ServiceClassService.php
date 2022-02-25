<?php

namespace App\Services\Master;

use App\Models\Master\Language\Language;
use App\Models\Master\ServiceClass\ServiceClass;
use Illuminate\Support\Facades\Auth;
use App\Models\Master\ServiceClass\ServiceClassTranslation;

class ServiceClassService
{
    public function edit($id)
    {
        $model = ServiceClass::where('id', $id)->with('translations.language')->first();

        $languages = Language::where('is_active', 1)->get();
        $not_languages = $languages->whereNotIn('code', $model->translations->pluck('language_code'));
        foreach ($not_languages as $not_language) {
            $new_lang = new ServiceClassTranslation();
            $new_lang->id = 0;
            $new_lang->service_class_id = $id;
            $new_lang->language_code = $not_language->code;
            $new_lang->name = '';
            $new_lang->language = $not_language;
            $model->translations->push($new_lang);
        }
        return $model;
    }

    public function update($id, $form)
    {
        $translations = $form['translations'];

        $service_class = ServiceClass::find($id);
        if (!$service_class) {
            $service_class = new ServiceClass();
            $service_class->created_by = Auth::id();
        }
        $service_class->code = $form['code'];
        $service_class->updated_by = Auth::id();
        $service_class->save();

        foreach ($translations as $translation) {
            $service_class_translation = ServiceClassTranslation::find($translation['id']);
            if (!$service_class_translation) {
                $service_class_translation = new ServiceClassTranslation();
            }
            $service_class_translation->service_class_id = $service_class->id;
            $service_class_translation->language_code = $translation['language_code'];
            $service_class_translation->name = $translation['name'];
            $service_class_translation->save();
        }
        return $service_class->id;
    }

    public function delete($id)
    {
        $service_class = ServiceClass::findOrFail($id);
        $service_class_translation = ServiceClassTranslation::where('service_class_id', $id);
        if ($service_class_translation) {
            $service_class_translation->delete();
        }
        $service_class->delete();
    }
}
