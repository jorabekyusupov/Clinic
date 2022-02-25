<?php

namespace App\Http\Requests\Master\SpecialtyType;

use Illuminate\Foundation\Http\FormRequest;

class SpecialtyTypeStoreUpdateRequest extends FormRequest
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
            'type' => ['required'],
            'translations.*.id' => 'integer',
            'translations.*.name' => ['string', 'max:255'],
            'translations.*.language_code' => ['string', 'max:25'],
            'translations.*.specialty_type_id' => 'integer'
        ];
    }
}
