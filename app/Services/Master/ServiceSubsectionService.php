<?php

namespace App\Services\Master;

use App\Models\Master\Language\Language;
use App\Models\Master\ServiceSubsection\ServiceSubsection;
use Illuminate\Support\Facades\Auth;
use App\Models\Master\ServiceSubsection\ServiceSubsectionTranslation;

class ServiceSubsectionService
{
    public function edit($id)
    {
        $model = ServiceSubsection::where('id', $id)->with('translations.language')->first();

        $languages = Language::where('is_active', 1)->get();
        $not_languages = $languages->whereNotIn('code', $model->translations->pluck('language_code'));
        foreach ($not_languages as $not_language) {
            $new_lang = new ServiceSubsectionTranslation();
            $new_lang->id = 0;
            $new_lang->service_subsection_id = $id;
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

        $service_subsection = ServiceSubsection::find($id);
        if (!$service_subsection) {
            $service_subsection = new ServiceSubsection();
            $service_subsection->created_by = Auth::id();
        }
        $service_subsection->code = $form['code'];
        $service_subsection->updated_by = Auth::id();
        $service_subsection->save();

        foreach ($translations as $translation) {
            $service_subsection_translation = ServiceSubsectionTranslation::find($translation['id']);
            if (!$service_subsection_translation) {
                $service_subsection_translation = new ServiceSubsectionTranslation();
            }
            $service_subsection_translation->service_subsection_id = $service_subsection->id;
            $service_subsection_translation->language_code = $translation['language_code'];
            $service_subsection_translation->name = $translation['name'];
            $service_subsection_translation->save();
        }
        return $service_subsection->id;
    }

    public function delete($id)
    {
        $service_subsection = ServiceSubsection::findOrFail($id);
        $service_subsection_translation = ServiceSubSectionTranslation::where('service_section_id', $id);
        if ($service_subsection_translation) {
            $service_subsection_translation->delete();
        }
        $service_subsection->delete();
    }
}
