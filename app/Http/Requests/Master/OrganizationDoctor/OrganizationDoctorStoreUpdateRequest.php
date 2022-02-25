<?php

namespace App\Http\Requests\Master\OrganizationDoctor;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class OrganizationDoctorStoreUpdateRequest extends FormRequest
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
    public $id, $organization_id, $doctor_id;

    public function rules()
    {
        $id = $this->route('organization_doctor');
        $organization_id = request()->input('organization_id');
        $doctor_id = request()->input('doctor_id');
        $unique = Rule::unique('organization_doctors')->where(function ($query) use ($organization_id, $doctor_id) {
            return $query->where('organization_id', $organization_id)
                ->where('doctor_id', $doctor_id);
        });
        if (request()->isMethod('PUT')) {
            $unique = $unique->ignore($id);
        }

        return [
            'organization_id' => ['required', $unique],
            'doctor_id' => ['required', $unique]
        ];
    }

}
