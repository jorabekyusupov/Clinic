<?php

namespace App\Http\Requests\Master\OrganizationType;

use Illuminate\Foundation\Http\FormRequest;

class OrganizationTypeStoreUpdateRequest extends FormRequest
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
            'translations.*.id' => 'nullable',
            'translations.*.name' => 'nullable',
            'translations.*.language_code' => 'nullable',
            'translations.*.description' => 'nullable',
        ];
    }
}
