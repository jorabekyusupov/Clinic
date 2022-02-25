<?php

namespace App\Http\Requests\Master\Permission;

use Illuminate\Foundation\Http\FormRequest;

class PermissionIndexRequest extends FormRequest
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
            'search' => ['nullable', 'string'],
            'language' => ['required', 'string'],
            'role_id' => 'nullable',
            'not_in_role' => 'nullable',
            'page' => ['nullable', 'integer'],
            'rows' => ['nullable', 'integer'],
        ];
    }
}
