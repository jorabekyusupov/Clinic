<?php

namespace App\Http\Requests\Master\Contact;

use Illuminate\Foundation\Http\FormRequest;

class ContactStoreUpdateRequest extends FormRequest
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
            'contacts.*.id' => ['required', 'integer'],
            'contacts.*.object_id' => ['nullable', 'integer'],
            'contacts.*.object_type' => ['required', 'string', 'max:100'],
            'contacts.*.contact_type' => ['required', 'string', 'max:100'],
            'contacts.*.value' => ['nullable', 'string', 'max:255'],
        ];
    }
}
