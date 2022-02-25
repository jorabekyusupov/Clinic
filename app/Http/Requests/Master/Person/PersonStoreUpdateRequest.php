<?php

namespace App\Http\Requests\Master\Person;

use Illuminate\Foundation\Http\FormRequest;

class PersonStoreUpdateRequest extends FormRequest
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
           'first_name' => ['required'],
           'last_name' => ['nullable'],
           'middle_name' => ['nullable'],
           'born_date' => ['nullable'],
           'jshshir' => ['nullable'],
           'gender' => ['required']
        ];
    }
}
