<?php

namespace App\Http\Requests\Master\DoctorStudy;

use Illuminate\Foundation\Http\FormRequest;

class DoctorStudyUpdateRequest extends FormRequest
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
            'doctor_id' => 'required',
            'study_type_id' => 'required',
            'university_id' => 'nullable',
            'study_degree_id' => 'nullable',
            'specialty_id' => 'nullable',
            'direction' => ['nullable', 'string', 'max:255'],
            'description' => ['nullable', 'string', 'max:255'],
            'began_year' => ['required', 'integer'],
            'graduated_year' => ['required', 'integer'],
        ];
    }
}

