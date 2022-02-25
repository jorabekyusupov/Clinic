<?php

namespace App\Http\Requests\Master\Language;

use Illuminate\Foundation\Http\FormRequest;

class LanguageStoreUpdateRequest extends FormRequest
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
        $id = $this->route('language');
        $code = 'required';
        if (request()->isMethod('POST')) {
            $code = ['required', 'unique:languages,code'];
        } elseif (request()->isMethod('PUT')) {
            $code = ['required', 'unique:languages,code,'.$id];
        }
        return [
            'code' => $code,
            'name' => ['required'],
            'is_active' => ['required']
        ];
    }
}
