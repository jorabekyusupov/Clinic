<?php

namespace App\Http\Requests\Master\Doctor;

use Illuminate\Foundation\Http\FormRequest;

class DoctorStoreUpdateRequest extends FormRequest
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
        $id = $this->route('doctor');
        $person = 'required';
        if (request()->isMethod('POST')) {
            $person = ['required', 'unique:doctors,person_id'];
        } elseif (request()->isMethod('PUT')) {
            $person = ['required', 'unique:doctors,person_id,'.$id];
        }

        return [
            'person_id' => $person,
            'status' => 'required'
        ];
    }
}
