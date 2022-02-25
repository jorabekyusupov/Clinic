<?php

namespace App\Services\Master\Organization;

use App\Services\MainService;
use App\Repositories\Master\Organization\OrganizationRepository;
use App\Services\Service;
use App\Services\Master\User\UserService;
use Illuminate\Support\Str;

class OrganizationService extends Service
{
    protected MainService $mainService;
    protected UserService $userService;
    private array $relationsList = ['default_picture', 'contacts', 'workSchedules'];

    public function __construct(
        OrganizationRepository     $organizationRepository,
        MainService                $mainService,
        UserService                $userService
    )
    {
        $this->mainService = $mainService;
        $this->repository = $organizationRepository;
        $this->userService = $userService;
    }

    public function indexOrganization($data)
    {
        $search = $data['search'] ?? null;
        $language = $data['language'];
        $page = $data['page'] ?? 1;
        $rows = $data['rows'] ?? 1000;
        $organizations = $this->get()->with('contacts')
            ->with('workSchedules')
            ->whereHas('translations', function ($q) use ($search) {
                $q->where('name', 'like', '%' . $search . '%');
            })
            ->with([
                'defaultPicture' => function ($q) {
                    $q->where('object_type', 'organization');
                }
            ])
            ->with([
                'translation' => function ($q) use ($language) {
                    $q->where('language_code', $language);
                }
            ])->orderBy('id');

        return $organizations->paginate($rows, ['*'], 'page name', $page);
    }

    public function showOrganization($id)
    {
        $model = $this->show($id, [
            $this->mainService->translation_relation,
            'contacts',
            'workSchedules',
            'defaultPicture',
            'organizationType',
        ]);
        if ($model) {
            $data = [
                'organization_id' => $id,
                'address' => '',
                'name' => '',
            ];
            return response()->json($this->mainService->showWithTranslations($model, $data));
        } else {
            return response()->json('Not found', 404);
        }
    }

    public function storeOrganization($data)
    {
        try {
            $data['created_by'] = $this->mainService->auth::id();
            $data['database_name'] = env('DB_PREFIX', 'med') . '_' . Str::random(8);
            $organization = $this->store($data);
            $this->storeTranslation($organization->id, $data['translations'], 'organization_id');

            // Create new DB for organization
//            $new_db = $this->mainService->createOrganization($organization->id);
//            $this->userService->edit(auth()->id(), ['default_database' => $data['database_name']]);

            return response()->json($organization->id, 201);
        } catch (\Throwable $throwable) {
            info($throwable->getMessage());
            return response()->json('Not implemented', 501);
        }
    }

    public function updateOrganization($id, $data)
    {
        try {
            $data['updated_by'] = $this->mainService->auth::id();
            $organization = $this->edit($id, $data);
            $this->editTranslation($id, $data['translations'], 'organization_id');
            return response()->json($organization->id);
        } catch (\Throwable $throwable) {
            info($throwable->getMessage());
            return response()->json($throwable->getMessage(), 500);
        }
    }

    public function listOrganization($data)
    {
        $language = $data['language'];
        $models = $this->getView($this->relationsList)->whereNull('deleted_at')->where('language_code', $language)
            ->with([
                'organizationType' => function ($q) use ($language) {
                    $q->select('id', 'name', 'description')->where('language_code', $language)->first();
                }
            ]);

        return $this->mainService->list($data, $models, ['name', 'address']);
    }

}
