<?php

namespace App\Http\Requests\Master\Permission;

use Illuminate\Foundation\Http\FormRequest;

class PermissionStoreUpdateRequest extends FormRequest
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
        $id = $this->route('permission');
        $name = 'required';
        if (request()->isMethod('POST')) {
            $name = ['required', 'unique:permissions,name'];
        } elseif (request()->isMethod('PUT')) {
            $name = ['required', 'unique:permissions,name,'.$id];
        }

        return [
            'name' => $name,
            'type' => 'required',
            'translations.*.id' => 'nullable',
            'translations.*.language_code' => 'nullable',
            'translations.*.display_name' => 'nullable',
            'translations.*.description' => 'nullable',
        ];
    }
}
