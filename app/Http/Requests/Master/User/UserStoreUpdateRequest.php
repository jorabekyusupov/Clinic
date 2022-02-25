<?php

namespace App\Http\Requests\Master\User;

use Illuminate\Foundation\Http\FormRequest;

class UserStoreUpdateRequest extends FormRequest
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
        $id = $this->route('user');
        $username = $email = 'nullable';
        if (request()->isMethod('POST')) {
            $username = ['required', 'unique:users,username'];
            $email = ['nullable', 'email', 'unique:users,email'];
        } elseif (request()->isMethod('PUT')) {
            $username = ['required', 'unique:users,username,'.$id];
            $email = ['nullable', 'email', 'unique:users,email,'.$id];
        }

        return [
            'username' => $username,
            'email' => $email,
            'password' => ['required', 'confirmed'],
            'status' => 'boolean',
            'person_id' => 'nullable'
        ];
    }
}
