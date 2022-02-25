<?php

namespace App\Http\Requests\Master\ContentWord;

use Illuminate\Foundation\Http\FormRequest;

class ContentWordStoreUpdateRequest extends FormRequest
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
        $id = $this->route('content_word');
        $word = '';
        if (request()->isMethod('POST')) {
            $word = ['required', 'unique:content_words,word'];
        } elseif (request()->isMethod('PUT')) {
            $word = ['required', 'unique:content_words,word,'.$id];
        }

        return [
            'word' => $word,
            'status' => 'required',
            'translations.*.id' => 'nullable',
            'translations.*.language_code' => 'nullable',
            'translations.*.translation' => 'nullable'
        ];
    }
}
