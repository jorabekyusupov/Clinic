<?php

namespace App\Http\Requests\Master\DoctorSpecialty;

use Illuminate\Foundation\Http\FormRequest;

class DoctorSpecialtyToggleRequest extends FormRequest
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
            'doctor_id' => ['required'],
            'specialty_id' => ['required'],
            'type' => ['nullable']
        ];
    }
}
