<?php

namespace App\Http\Requests\Master\Organization;

use Illuminate\Foundation\Http\FormRequest;
use phpDocumentor\Reflection\PseudoTypes\True_;

class OrganizationIndexRequest extends FormRequest
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
            'search' => ['nullable'],
            'language' => ['required'],
            'rows' => 'nullable',
            'page' => 'nullable'
        ];
    }
}
