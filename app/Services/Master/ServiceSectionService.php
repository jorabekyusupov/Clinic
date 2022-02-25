<?php

namespace App\Services\Master;

use App\Models\Master\Language\Language;
use App\Models\Master\ServiceSection\ServiceSection;
use Illuminate\Support\Facades\Auth;
use App\Models\Master\ServiceSection\ServiceSectionTranslation;

class ServiceSectionService
{
    public function edit($id)
    {
        $model = ServiceSection::where('id', $id)->with('translations.language')->first();

        $languages = Language::where('is_active', 1)->get();
        $not_languages = $languages->whereNotIn('code', $model->translations->pluck('language_code'));
        foreach ($not_languages as $not_language) {
            $new_lang = new ServiceSectionTranslation();
            $new_lang->id = 0;
            $new_lang->service_section_id = $id;
            $new_lang->language_code = $not_language->code;
            $new_lang->language = $not_language;
            $new_lang->name = '';
            $model->translations->push($new_lang);
        }

        return $model;
    }

    public function update($id, $form)
    {
        $translations = $form['translations'];

        $service_section = ServiceSection::find($id);
        if (!$service_section) {
            $service_section = new ServiceSection();
            $service_section->created_by = Auth::id();
        }
        $service_section->code = $form['code'];
        $service_section->updated_by = Auth::id();
        $service_section->save();

        foreach ($translations as $translation) {
            $service_section_translation = ServiceSectionTranslation::find($translation['id']);
            if (!$service_section_translation) {
                $service_section_translation = new ServiceSectionTranslation();
            }
            $service_section_translation->service_section_id = $service_section->id;
            $service_section_translation->language_code = $translation['language_code'];
            $service_section_translation->name = $translation['name'];
            $service_section_translation->save();
        }
        return $service_section->id;
    }

    public function delete($id)
    {
        $service_section = ServiceSection::findOrFail($id);
        $service_section_translation = ServiceSectionTranslation::where('service_section_id', $id);
        if ($service_section_translation) {
            $service_section_translation->delete();
        }
        $service_section->delete();
    }
}
