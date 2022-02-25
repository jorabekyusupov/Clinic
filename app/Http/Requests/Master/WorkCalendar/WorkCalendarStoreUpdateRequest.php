<?php

namespace App\Http\Requests\Master\WorkCalendar;

use Illuminate\Foundation\Http\FormRequest;

class WorkCalendarStoreUpdateRequest extends FormRequest
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
            'calendar_date' => ['nullable', 'date'],
            'work_day_sequence' => ['nullable', 'integer'],
            'is_work_day' => ['nullable', 'boolean'],
            'is_weekend' => ['nullable', 'boolean'],
            'is_holiday' => ['nullable', 'boolean'],
            'holiday_name' => ['nullable', 'string', 'max:55'],
        ];
    }
}
