<?php

namespace App\Http\Requests\Master\OrganizationService;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class OrganizationServiceStoreUpdateRequest extends FormRequest
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
    public $id, $organization_id, $service_id;

    public function rules()
    {
        $id = $this->route('organization_service');
        $organization_id = request()->input('organization_id');
        $service_id = request()->input('service_id');
        $unique = Rule::unique('organization_services')->where(function ($query) use ($organization_id, $service_id) {
            return $query->where('organization_id', $organization_id)
                ->where('service_id', $service_id);
        });
        if (request()->isMethod('PUT')) {
            $unique = $unique->ignore($id);
        }

        return [
            'organization_id' => ['required', $unique],
            'service_id' => ['required', $unique]
        ];
    }

}
