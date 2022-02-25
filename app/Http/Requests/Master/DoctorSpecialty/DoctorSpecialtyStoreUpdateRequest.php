<?php

namespace App\Http\Requests\Master\DoctorSpecialty;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class DoctorSpecialtyStoreUpdateRequest extends FormRequest
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

        $id = $this->route('doctor_specialty');
        $doctor_id = request()->input('doctor_id');
        $specialty_id = request()->input('specialty_id');
        $unique = Rule::unique('doctor_specialties')->where(function ($query) use ($specialty_id, $doctor_id) {
            return $query->where('specialty_id', $specialty_id)
                ->where('doctor_id', $doctor_id);
        });
        if (request()->isMethod('PUT')) {
            $unique = $unique->ignore($id);
        }

        return [
            'doctor_id' => ['required', $unique],
            'specialty_id' => ['required', $unique],
            'certificate_due_date' => ['nullable'],
            'certificate_taken_date' => ['nullable'],
        ];
    }

}
