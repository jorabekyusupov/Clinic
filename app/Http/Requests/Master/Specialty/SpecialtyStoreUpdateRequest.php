<?php

namespace App\Http\Requests\Master\Specialty;

use Illuminate\Foundation\Http\FormRequest;

class SpecialtyStoreUpdateRequest extends FormRequest
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
            'specialty_type_id' => ['required'],
            'translations.*.id' => 'integer',
            'translations.*.name' => ['string', 'max:255'],
            'translations.*.language_code' => ['string', 'max:25'],
            'translations.*.specialty_id' => 'integer'
        ];
    }
}
