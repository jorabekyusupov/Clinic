<?php

namespace App\Http\Requests\Master\WorkCalendar;

use Illuminate\Foundation\Http\FormRequest;

class WorkCalendarIndexRequest extends FormRequest
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
            'search' => 'nullable',
            'rows' => ['nullable', 'integer'],
            'page' => ['nullable', 'integer']
        ];
    }
}
