<?php

namespace App\Http\Requests\Master\WeeklySchedule;

use Illuminate\Foundation\Http\FormRequest;

class WeeklyScheduleIndexRequest extends FormRequest
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
            'search' => ['nullable'],
            'language' => ['required']
        ];
    }
}
