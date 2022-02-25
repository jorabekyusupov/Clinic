<?php

namespace App\Http\Requests\Master\Category;

use Illuminate\Foundation\Http\FormRequest;

class CategoryIndexRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true ;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
          'search' => ['nullable'],
          'language' => ['required'],
          'organization_id' => ['nullable'],
          'page' => ['nullable', 'integer'],
          'rows' => ['nullable', 'integer']
        ];
    }
}
