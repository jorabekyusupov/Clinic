<?php

namespace Tests\Feature;

use App\Models\Master\Organization\Organization;
use App\Models\Master\OrganizationService\OrganizationService;
use App\Models\Master\Service\Service;
use App\Models\Master\OrganizationType\OrganizationType;
use App\Models\Master\Service\ServiceTranslation;
use App\Models\Master\WeeklySchedule\WeeklySchedule;

class OrganizationServiceTest extends Base
{
    public function setUp() : void
    {
        $this->hasTranslation = false;
        $this->modelName = 'organization-service';
        $this->modelClass = OrganizationService::class;

        $this->indexStructure = [
            '*' => [
                'id',
                'organization_id',
                'service_id',
                'price',
                'created_at',
                'created_by',
                'updated_at',
                'updated_by',
                'deleted_at',
                'deleted_by',
                'service' => [
                    'id',
                    'code',
                    'category_id',
                    'created_by',
                    'created_at',
                    'updated_by',
                    'updated_at',
                    'deleted_by',
                    'deleted_at',
                    'service_translation_id',
                    'language_code',
                    'name',
                ]
            ]
        ];

        $this->rawData = [
            'organization_id' => 1,
            'service_id' => 1,
            'price' => 100
        ];

        parent::setUp();
    }


    // create

    // create da agar header token berilsa va form ma'lumotlari jo'natilsa, 201 qaytishi kerak
    // qaytgan response strukturasi belgilangan strukturaga mos kelishi kk
    // qaytgan response tarkibida jo'natilgan ma'lumotlar bo'lishi kerak
    public function test_can_create_item()
    {
        $this->createRelationalData();

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
        $rawData = $rawData2 = $this->rawData;
        unset($rawData['organization_id']);
        unset($rawData2['service_id']);

        $this->json("post", route($this->modelName . '.store'), $rawData, $this->getHeadersWithToken())
            ->assertStatus(422);

        $this->json("post", route($this->modelName . '.store'), $rawData2, $this->getHeadersWithToken())
            ->assertStatus(422);
    }

    // create da unique fieldarni qayta post qilinsa xato qaytishi kerak
    public function test_return_validation_error_when_send_dublicate_data_on_create()
    {
        $this->createRelationalData();

        OrganizationService::factory()->create($this->rawData);

        $this->json("post", route($this->modelName . '.store'), $this->rawData, $this->getHeadersWithToken())
            ->assertStatus(422);
    }



    // update

    // update da agar header token berilsa va form ma'lumotlari jo'natilsa, 200 qaytishi kerak
    public function test_can_update_item()
    {
        $this->createRelationalData();
        $model = OrganizationService::factory()->create($this->rawData);

        $this->putJson(route($this->modelName . '.update', [$this->paramName => $model->id]), $this->rawData, $this->getHeadersWithToken())
            ->assertStatus(200);
    }

    // update da agar headerda token berilmasa, 401 qaytishi kerak
    public function test_return_unauthorized_error_when_token_is_wrong_on_update()
    {
        $this->createRelationalData();
        $model = OrganizationService::factory()->create($this->rawData);

        $this->putJson(route($this->modelName . '.update', [$this->paramName => $model->id]), $this->rawData)
            ->assertStatus(401);
    }

    // updateda agar required fieldlar jonatilmasa xato qaytishi kerak
    public function test_return_validation_error_without_sending_required_fields_on_update()
    {
        $models = $this->createRelationalData();
        $organization = $models['organization'];
        $service = $models['service'];
        $model = OrganizationService::factory()->create($this->rawData);

        $rawData = [
            'organization_id' => $organization->id,
        ];

        $rawData2 = [
            'service_id' => $service->id
        ];

        $this->putJson(route($this->modelName . '.update', [$this->paramName => $model->id]), $rawData, $this->getHeadersWithToken())
            ->assertStatus(422);

        $this->putJson(route($this->modelName . '.update', [$this->paramName => $model->id]), $rawData2, $this->getHeadersWithToken())
            ->assertStatus(422);
    }


    // index

    // index da agar headerda token berilsa,
    // required param bo'lgan language berilsa,
    // 200 qaytishi kerak
    public function test_can_index_items()
    {
        $models = $this->createRelationalData();
        $organization = $models['organization'];
        $model = OrganizationService::factory()->create($this->rawData);
        $params = [
            'organization_id' => $organization->id,
            'language' => 'uz'
        ];

        // dd($this->getJson(route($this->modelName . '.index',$params), $this->getHeadersWithToken()));

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

    // agar indexda required paramlar berilmasa 422 qaytishi kerak
    public function test_return_validation_error_when_required_params_not_sent_on_index()
    {
        $this->getJson(route($this->modelName . '.index',[]), $this->getHeadersWithToken())
            ->assertStatus(422);
    }



    // delete

    // delete da agar header token berilsa 204 (NO CONTENT) status qaytishi kerak
    public function test_can_delete_item()
    {
        $this->createRelationalData();
        $model = OrganizationService::factory()->create($this->rawData);

        $this->deleteJson(route($this->modelName . '.destroy', [$this->paramName => $model->id]),[], $this->getHeadersWithToken())
            ->assertStatus(204);
    }

    // delete da agar headerda token berilmasa, 401 qaytishi kerak
    public function test_return_unauthorized_error_when_token_is_wrong_on_delete()
    {
        $this->createRelationalData();
        $model = OrganizationService::factory()->create($this->rawData);

        $this->deleteJson(route($this->modelName . '.destroy', [$this->paramName => $model->id]))
            ->assertStatus(401);
    }

    // delete da agar berilgan model_id topilmasa xato qaytishi kerak
    public function test_return_not_found_error_when_wrong_item_id_is_sent_on_delete()
    {
        $this->createRelationalData();
        $model = OrganizationService::factory()->create($this->rawData);

        $this->deleteJson(route($this->modelName . '.destroy', [$this->paramName => $model->id + 1]), $this->getHeadersWithToken())
            ->assertStatus(404);
    }


    // toggle

    // toggle da agar header token berilsa va form ma'lumotlari jo'natilsa va type = 1 bo'lsa, 200 qaytishi kerak
    public function test_can_toggle_create_item()
    {
        $models = $this->createRelationalData();
        $organization = $models['organization'];
        $service = $models['service'];

        $formData = [
            'organization_id' => $organization->id,
            'service_id' => $service->id,
            'type' => 1,
        ];

        $this->json("post", route($this->modelNamePlural . '.toggle'), $formData, $this->getHeadersWithToken())
            ->assertStatus(200);
    }

    // toggle da agar headerda token berilmasa, 401 qaytishi kerak
    public function test_return_unauthorized_error_when_token_is_wrong_on_toggle()
    {
        $models = $this->createRelationalData();
        $organization = $models['organization'];
        $service = $models['service'];

        $formData = [
            'organization_id' => $organization->id,
            'service_id' => $service->id,
            'type' => 1,
        ];

        $this->json("post", route($this->modelNamePlural . '.toggle'), $formData)
            ->assertStatus(401);
    }

    // toggle da agar required fieldlar jo'natilmasa 422 xato qaytishi kerak
    public function test_return_validation_error_when_required_fields_not_sent_on_toggle()
    {
        $formData = [];

        $this->json("post", route($this->modelNamePlural . '.toggle'), $formData, $this->getHeadersWithToken())
            ->assertStatus(422);
    }

    protected function createRelationalData(){

        $organizationType = OrganizationType::factory()->create();
        $weeklySchedule = WeeklySchedule::factory()->create();
        $params['organization_type_id'] = $organizationType->id;
        $params['weekly_schedule_id'] = $weeklySchedule->id;
        $params['status'] = 1;
        $organization = Organization::factory()->create($params);
        $service = Service::factory()->create();
        ServiceTranslation::factory()->create(['service_id' => $service->id, 'language_code' => 'uz']);
        ServiceTranslation::factory()->create(['service_id' => $service->id, 'language_code' => 'ru']);
        ServiceTranslation::factory()->create(['service_id' => $service->id, 'language_code' => 'uzc']);

        $this->rawData['organization_id'] = $organization->id;
        $this->rawData['service_id'] = $service->id;
        return compact('organization', 'service');
    }


}
