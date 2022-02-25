<?php

namespace App\Http\Requests\Master\Organization;

use Illuminate\Foundation\Http\FormRequest;

class OrganizationStoreUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'organization_type_id' => 'required',
            'weekly_schedule_id' => 'required',
            'status' => 'required',
            'translations.*.id' => 'nullable',
            'translations.*.organization_id' => 'nullable',
            'translations.*.language_code' => 'nullable',
            'translations.*.name' => 'nullable',
            'translations.*.address' => 'nullable',
        ];
    }
}
