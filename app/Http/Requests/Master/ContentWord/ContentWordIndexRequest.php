<?php

namespace App\Http\Requests\Master\ContentWord;

use Illuminate\Foundation\Http\FormRequest;

class ContentWordIndexRequest extends FormRequest
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
