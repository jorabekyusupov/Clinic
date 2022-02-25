<?php

namespace App\Http\Requests\Master\WeeklySchedule;

use Illuminate\Foundation\Http\FormRequest;

class WeeklyScheduleStoreUpdateRequest extends FormRequest
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
            'code' => ['required'],
            'translations.*.id' => 'integer',
            'translations.*.name' => ['string', 'max:255'],
            'translations.*.language_code' => ['string', 'max:25'],
            'translations.*.weekly_schedule_id' => 'integer'
        ];
    }
}
