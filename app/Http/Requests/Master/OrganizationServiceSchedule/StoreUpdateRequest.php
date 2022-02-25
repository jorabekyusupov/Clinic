<?php

namespace App\Http\Requests\Master\OrganizationServiceSchedule;

use Illuminate\Foundation\Http\FormRequest;

class StoreUpdateRequest extends FormRequest
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
        $unique = 'Yozish kerak';

        return [
            'organization_id' => ['required', 'integer'], //$unique
            'service_id' => ['required', 'integer'],
            'calendar_date' => ['required', 'date'],
            'doctor_id' => ['nullable', 'integer'],
            'organization_equipment_id' => ['nullable', 'integer'],
            'start_time' => ['required', 'string', 'min:2', 'max:5'],
            'end_time' => ['required', 'string', 'min:2', 'max:5'],
            'type' => ['required', 'integer'],
        ];
    }
}
