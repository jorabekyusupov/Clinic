<?php

namespace App\Http\Requests\Master\Category;

use Illuminate\Foundation\Http\FormRequest;

class CategoryStoreUpdateRequest extends FormRequest
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
            'code' => 'nullable',
            'translations.*.id' => 'integer',
            'translations.*.name' => ['string', 'max:255'],
            'translations.*.language_code' => ['string', 'max:25'],
            'translations.*.category_id' => 'integer'
        ];
    }
}
