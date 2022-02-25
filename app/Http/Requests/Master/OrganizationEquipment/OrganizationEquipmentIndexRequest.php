<?php

namespace App\Http\Requests\Master\OrganizationEquipment;

use Illuminate\Foundation\Http\FormRequest;

class OrganizationEquipmentIndexRequest extends FormRequest
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
            'language' => ['required', 'string'],
            'organization_id' => ['required', 'integer'],
        ];
    }
}
