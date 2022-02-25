<?php

namespace App\Services\Master\OrganizationType;

use App\Services\MainService;
use App\Repositories\Master\OrganizationType\OrganizationTypeRepository;
use App\Services\Service;

class OrganizationTypeService extends Service
{
    protected
        $mainService,
        $auth_id;

    public function __construct(
        MainService                    $mainService,
        OrganizationTypeRepository     $organizationTypeRepository
    ) {

        $this->repository = $organizationTypeRepository;
        $this->mainService = $mainService;
    }

    public function indexOrganizationType($data)
    {
        $language = $data['language'];
        $search = $data['search'] ?? null;
        $organization_types = $this->getView()
            ->where('language_code', $language);
        if (isset($search)) {
            $organization_types->where(function ($q) use ($search) {
                $q->where('name', 'ilike', '%' . $search . '%')
                    ->orWhere('description', 'ilike', '%' . $search . '%');
            });
        }

        return $organization_types->paginate(1000);
    }

    public function showOrganizationType($id)
    {
        $model = $this->show($id, [$this->mainService->translation_relation]);
        if ($model) {
            $data = [
                'organization_type_id' => $id,
                'name' => '',
                'description' => '',
            ];
            return response()->json($this->mainService->showWithTranslations($model, $data));
        } else {
            return response()->json('Not found', 404);
        }
    }

    public function storeOrganizationType($data)
    {
        try {
            $data['created_by'] = $this->mainService->auth::id();
            $organization_type = $this->store($data);
            $this->storeTranslation($organization_type->id, $data['translations'], 'organization_type_id');
            return response()->json($organization_type->id, 201);
        } catch (\Throwable $throwable) {
            info($throwable->getMessage());
            return response()->json('Not implemented', 501);
        }
    }

    public function updateOrganizationType($id, $data)
    {
        try {
            $data['updated_by'] = $this->mainService->auth::id();
            $organization_type = $this->edit($id, $data);
            $this->editTranslation($id, $data['translations'], 'organization_type_id');
            return response()->json($organization_type->id);
        } catch (\Throwable $throwable) {
            info($throwable->getMessage());
            return response()->json('Not found', 404);
        }
    }

    public function listOrganizationType($data)
    {
        $models = $this->getView()->where('language_code',  $data['language'])->latest();
        return $this->mainService->list($data, $models, ['name', 'description']);
    }
}
