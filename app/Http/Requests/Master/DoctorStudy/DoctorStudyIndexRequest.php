<?php

namespace App\Http\Requests\Master\DoctorStudy;

use Illuminate\Foundation\Http\FormRequest;

class DoctorStudyIndexRequest extends FormRequest
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
            'language' => 'required',
            'doctor_id' => 'required',
        ];
    }
}
