<?php

namespace App\Http\Requests\Master\Role;

use Illuminate\Foundation\Http\FormRequest;

class RoleToggleRequest extends FormRequest
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
        $common_rule = ['required', 'integer'];
        return [
            'role_id' => $common_rule,
            'permission_id' => $common_rule,
            'type' => $common_rule
        ];
    }
}
