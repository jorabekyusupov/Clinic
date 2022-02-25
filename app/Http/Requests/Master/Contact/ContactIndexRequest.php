<?php

namespace App\Http\Requests\Master\Contact;

use Illuminate\Foundation\Http\FormRequest;

class ContactIndexRequest extends FormRequest
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
            'object_type' => ['required', 'string', 'max:100'],
            'object_id' => ['required', 'integer'],
        ];
    }
}
