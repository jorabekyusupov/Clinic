<?php

namespace Tests\Feature;

use App\Models\Master\Organization\Organization;
use App\Models\Master\OrganizationEquipment\OrganizationEquipment;
use App\Models\Master\OrganizationEquipment\OrganizationEquipmentTranslation;
use App\Models\Master\OrganizationType\OrganizationType;
use App\Models\Master\WeeklySchedule\WeeklySchedule;

class OrganizationEquipmentTest extends Base
{
    public function setUp() : void
    {
        $this->modelName = 'organization-equipment';
        $this->modelClass = OrganizationEquipment::class;
        $this->modelTranslationClass = OrganizationEquipmentTranslation::class;

        parent::setUp();

        $this->singleStructure = [
            'id',
            'organization_id',
            'created_at',
            'created_by',
            'updated_at',
            'updated_by',
            'deleted_at',
            'deleted_by',
            'translations' => [
                '*' => [
                    'id',
                    'organization_equipment_id',
                    'language_code',
                    'name',
                    'language'
                ],
            ]
        ];

        $this->indexStructure = [
            'current_page',
            'data' => [
                '*' => [
                    'id',
                    'organization_id',
                    'created_by',
                    'updated_by',
                    'deleted_by',
                    'updated_at',
                    'created_at',
                    'deleted_at',
                    'organization_equipment_translation_id',
                    'language_code',
                    'name',
                ]
            ],
            'first_page_url',
            'from',
            'last_page',
            'last_page_url',
            'next_page_url',
            'path',
            'per_page',
            'prev_page_url',
            'to',
            'total'
        ];

        $this->rawData = [
            'organization_id' => 1,
            'translations' => [
                [
                    'language_code' => 'ru',
                    'name' => 'Test service ru',
                ],
                [
                    'language_code' => 'uz',
                    'name' => 'Test service uz',
                ],
                [
                    'language_code' => 'uzc',
                    'name' => 'Test service uzc',
                ]
            ],
        ];

    }


    // create

    // create da agar header token berilsa va form ma'lumotlari jo'natilsa, 201 qaytishi kerak
    // qaytgan response strukturasi belgilangan strukturaga mos kelishi kk
    // qaytgan response tarkibida jo'natilgan ma'lumotlar bo'lishi kerak
    public function test_can_create_item()
    {
        $this->json("post", route($this->modelName . '.store'), $this->rawData, $this->getHeadersWithToken())
            ->assertStatus(201);
    }

    // create da agar headerda token berilmasa, 401 qaytishi kerak
    public function test_return_unauthorized_error_when_token_is_wrong_on_create()
    {
        $this->json("post", route($this->modelName . '.store'), $this->rawData)
            ->assertStatus(401);
    }

    // create da agar required fieldlar jo'natilmasa 422 xato qaytishi kerak
    public function test_return_validation_error_when_required_fields_not_sent_on_create()
    {
        $rawData = $this->rawData;
        unset($rawData['organization_id']);

        $this->json("post", route($this->modelName . '.store'), $rawData, $this->getHeadersWithToken())
            ->assertStatus(422);
    }

    // create da agar Body raw da kerakli strukturada json data jo'natilmasa 501 xato qaytishi kerak
    public function test_return_implementation_error_when_body_structure_is_wrong_on_create()
    {
        $rawData = $this->rawData;
        $translations = $rawData['translations'];
        unset($rawData['translations']);
        $rawData['translations1'] = $translations;

        $this->json("post",route($this->modelName . '.store'), $rawData, $this->getHeadersWithToken())
            ->assertStatus(501);
    }



    // update

    // update da agar header token berilsa va form ma'lumotlari jo'natilsa, 200 qaytishi kerak
    public function test_can_update_item()
    {
        $model = $this->createModels()[0];
        $rawData = $this->prepareDataForUpdate($model);

        $this->putJson(route($this->modelName . '.update', [$this->paramName => $model->id]), $rawData, $this->getHeadersWithToken())
            ->assertStatus(200);

    }

    // update da agar headerda token berilmasa, 401 qaytishi kerak
    public function test_return_unauthorized_error_when_token_is_wrong_on_update()
    {
        $model = $this->createModels()[0];
        $rawData = $this->prepareDataForUpdate($model);

        $this->putJson(route($this->modelName . '.update', [$this->paramName => $model->id]), $rawData)
            ->assertStatus(401);
    }

    // update da agar required fieldlar jo'natilmasa 422 xato qaytishi kerak
    public function test_return_validation_error_when_required_fields_not_sent_on_update()
    {
        $model = $this->createModels()[0];
        $rawData = $this->prepareDataForUpdate($model);
        unset($rawData['organization_id']);

        $this->putJson(route($this->modelName . '.update', [$this->paramName => $model->id]), $rawData, $this->getHeadersWithToken())
            ->assertStatus(422);
    }


    // index

    // index da agar headerda token berilsa,
    // required param bo'lgan language berilsa,
    // 200 qaytishi kerak
    public function test_can_index_items()
    {
        $this->createModels(3);
        $organization = $this->createOrganization();
        $params = [
            'organization_id' => $organization->id,
            'language' => 'uz',
            'search' => ''
        ];

        $this->getJson(route($this->modelName . '.index',$params), $this->getHeadersWithToken())
            ->assertStatus(200)
            ->assertJsonStructure($this->indexStructure);
    }

    // index da agar headerda token berilmasa, 401 qaytishi kerak
    public function test_return_unauthorized_error_when_token_is_wrong_on_index()
    {
        $this->getJson(route($this->modelName . '.index'))
            ->assertStatus(401);
    }

    // index da agar headerda token berilsa va language berilmasa 422 qaytishi kerak
    public function test_return_validation_error_when_language_param_not_sent_on_index()
    {
        $this->createModels(3);

        $this->getJson(route($this->modelName . '.index'), $this->getHeadersWithToken())
            ->assertStatus(422);
    }



    // show

    // show da agar header token berilsa 200 qaytishi kerak
    // qaytgan response strukturasi belgilangan strukturaga mos kelishi kk
    // qaytgan response tarkibida jo'natilgan ma'lumotlar bo'lishi kerak
    public function test_can_show_item()
    {
        $model = $this->createModels()[0];

        $data = [
            'id' => $model->id,
        ];

        $this->getJson(route($this->modelName . '.show', [$this->paramName => $model->id]), $this->getHeadersWithToken())
            ->assertStatus(200)
            ->assertJsonStructure($this->singleStructure)
            ->assertJsonFragment($data);
    }

    // show da agar headerda token berilmasa, 401 qaytishi kerak
    public function test_return_unauthorized_error_when_token_is_wrong_on_show()
    {
        $model = $this->createModels()[0];

        $this->getJson(route($this->modelName . '.show', [$this->paramName => $model->id]))
            ->assertStatus(401);
    }

    // show da agar berilgan model_id topilmasa xato qaytishi kerak
    public function test_return_not_found_error_when_wrong_item_id_is_sent_on_show()
    {
        $model = $this->createModels()[0];
        $this->getJson(route($this->modelName . '.show', [$this->paramName => $model->id + 1]), $this->getHeadersWithToken())
            ->assertStatus(404);
    }



    // delete

    // delete da agar header token berilsa 204 (NO CONTENT) status qaytishi kerak
    public function test_can_delete_item()
    {
        $model = $this->createModels()[0];

        $this->deleteJson(route($this->modelName . '.destroy', [$this->paramName => $model->id]),[], $this->getHeadersWithToken())
            ->assertStatus(204);
    }

    // delete da agar headerda token berilmasa, 401 qaytishi kerak
    public function test_return_unauthorized_error_when_token_is_wrong_on_delete()
    {
        $model = $this->createModels()[0];

        $this->deleteJson(route($this->modelName . '.destroy', [$this->paramName => $model->id]))
            ->assertStatus(401);
    }

    // delete da agar berilgan model_id topilmasa xato qaytishi kerak
    public function test_return_not_found_error_when_wrong_item_id_is_sent_on_delete()
    {
        $model = $this->createModels()[0];

        $this->deleteJson(route($this->modelName . '.destroy', [$this->paramName => $model->id + 1]), $this->getHeadersWithToken())
            ->assertStatus(404);
    }



    protected function createOrganization(){
        $organizationType = OrganizationType::factory()->create();
        $weeklySchedule = WeeklySchedule::factory()->create();
        $params['organization_type_id'] = $organizationType->id;
        $params['weekly_schedule_id'] = $weeklySchedule->id;
        $params['status'] = 1;
        return Organization::factory()->create($params);
    }

    protected function createModels($count = 1){

        $organization = $this->createOrganization();

        $params = [
            'organization_id' => $organization->id,
            'created_by' => $this->user->id,
            'updated_by' => $this->user->id
        ];

        $models = $this->modelClass::factory($count)->create($params);

        if($this->hasTranslation){
           $models->each(function ($model) {
                $this->modelTranslationClass::factory()->create([$this->paramName . '_id' => $model->id, 'language_code' => 'uz']);
                $this->modelTranslationClass::factory()->create([$this->paramName . '_id' => $model->id, 'language_code' => 'uzc']);
                $this->modelTranslationClass::factory()->create([$this->paramName . '_id' => $model->id, 'language_code' => 'ru']);
            });
        }

        return $models;
    }


    private function prepareDataForUpdate($model){

        $translations = [];
        foreach ($model->translations as $tr) {
            $translations[] = [
                'id' => $tr->id,
                'organization_id' => $model->id,
                'translation' => $tr->translation . ' updated',
                'language_code' => $tr->language_code
            ];
        }

        $rawData = [
            'organization_id' => $model->id,
            'translations' => $translations
        ];

        return $rawData;

    }




}
