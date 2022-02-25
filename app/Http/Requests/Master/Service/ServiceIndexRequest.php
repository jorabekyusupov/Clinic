<?php

namespace App\Http\Requests\Master\Service;

use Illuminate\Foundation\Http\FormRequest;

class ServiceIndexRequest extends FormRequest
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
            'category_id' => ['nullable'],
            'not_in_category' => ['nullable'],
            'language' => ['required'],
            'search' => ['nullable'],
            'page' => ['nullable'],
            'rows' => ['nullable']
        ];
    }
}
