<?php

namespace Tests\Feature;

use App\Models\Master\Contact\Contact;
use App\Models\Master\Organization\Organization;
use App\Models\Master\OrganizationType\OrganizationType;
use App\Models\Master\WeeklySchedule\WeeklySchedule;

class ContactTest extends Base
{
    public function setUp() : void
    {
        $this->hasTranslation = false;
        $this->modelName = 'contact';
        $this->modelClass = Contact::class;

        parent::setUp();

        $this->indexStructure = [
            '*' => [
                'id',
                'object_type',
                'contact_type',
                'object_id',
                'value',
                'created_by',
                'updated_by',
                'created_at',
                'updated_at',
            ]
        ];

        $this->rawData = [
            'contacts' => [
                [
                    'id' => 1,
                    'object_type' => 'organization',
                    'contact_type' => 'phone',
                    'object_id' => 1,
                    'value' => '123456'
                ],
                [
                    'id' => 1,
                    'object_type' => 'organization',
                    'contact_type' => 'email',
                    'object_id' => 1,
                    'value' => 'test@email.com'
                ],
                [
                    'id' => 1,
                    'object_type' => 'organization',
                    'contact_type' => 'website',
                    'object_id' => 1,
                    'value' => 'www.test.com'
                ]
            ],
        ];

    }



    // update

    // update da agar header token berilsa va form ma'lumotlari jo'natilsa, 200 qaytishi kerak
    public function test_can_update_item()
    {
        $model = $this->createModels()[0];
        $rawData = $this->prepareDataForUpdate($model);

        $this->putJson(route($this->modelNamePlural . '.update', [$this->paramName => $model->id]), $rawData, $this->getHeadersWithToken())
            ->assertStatus(200);

    }

    // update da agar headerda token berilmasa, 401 qaytishi kerak
    public function test_return_unauthorized_error_when_token_is_wrong_on_update()
    {
        $model = $this->createModels()[0];
        $rawData = $this->prepareDataForUpdate($model);

        $this->putJson(route($this->modelNamePlural . '.update', [$this->paramName => $model->id]), $rawData)
            ->assertStatus(401);
    }

    // update da agar required fieldlar jo'natilmasa xato beradi
    public function test_return_validation_error_when_required_fields_not_sent_on_update()
    {
        $model = $this->createModels()[0];
        $rawData = $rawData2 = $rawData3 = $this->prepareDataForUpdate($model);
        unset($rawData['contacts'][0]['id']);
        unset($rawData2['contacts'][0]['object_type']);
        unset($rawData3['contacts'][0]['contact_type']);

        $this->putJson(route($this->modelNamePlural . '.update', [$this->paramName => $model->id]), $rawData, $this->getHeadersWithToken())
            ->assertStatus(422);
        $this->putJson(route($this->modelNamePlural . '.update', [$this->paramName => $model->id]), $rawData2, $this->getHeadersWithToken())
            ->assertStatus(422);
        $this->putJson(route($this->modelNamePlural . '.update', [$this->paramName => $model->id]), $rawData3, $this->getHeadersWithToken())
            ->assertStatus(422);

    }


    // index

    // index da agar headerda token berilsa,
    // required param bo'lgan language berilsa,
    // 200 qaytishi kerak
    public function test_can_index_items()
    {
        $models = $this->createModels(3);
        $params = [
            'object_type' => 'organization',
            'object_id' => $models[0]->object_id
        ];

        $this->getJson(route($this->modelNamePlural . '.index',$params), $this->getHeadersWithToken())
            ->assertStatus(200)
            ->assertJsonStructure($this->indexStructure);
    }

    // index da agar headerda token berilmasa, 401 qaytishi kerak
    public function test_return_unauthorized_error_when_token_is_wrong_on_index()
    {
        $this->getJson(route($this->modelNamePlural . '.index'))
            ->assertStatus(401);
    }

    // index da agar required paramlar jo'natilmasa xato berishi kk
    public function test_return_validation_error_when_required_params_not_sent_on_index()
    {
        $models = $this->createModels(3);
        $params = [
            'object_type' => 'organization',
        ];

        $params2 = [
            'object_id' => $models[0]->object_id
        ];

        $this->getJson(route($this->modelNamePlural . '.index',$params), $this->getHeadersWithToken())
            ->assertStatus(422);

        $this->getJson(route($this->modelNamePlural . '.index',$params2), $this->getHeadersWithToken())
            ->assertStatus(422);
    }



    protected function createOrganization(){
        $organizationType =OrganizationType::factory()->create();
        $weeklySchedule = WeeklySchedule::factory()->create();
        $params['organization_type_id'] = $organizationType->id;
        $params['weekly_schedule_id'] = $weeklySchedule->id;
        $params['status'] = 1;
        return Organization::factory()->create($params);
    }

    protected function createModels($count = 1){

        $organization = $this->createOrganization();
        $params = [
            'object_type' => 'organization',
            'object_id' => $organization->id,
        ];

        $models = $this->modelClass::factory($count)->create($params);
        // dd($models);
        return $models;
    }


    private function prepareDataForUpdate($model){

        $rawData = [
            'contacts' => [
                [
                    'id' => $model->id,
                    'object_type' => 'organization',
                    'contact_type' => 'phone',
                    'object_id' => $model->object_id,
                    'value' => $model->value . ' upd'
                ],
                [
                    'id' => $model->id,
                    'object_type' => 'organization',
                    'contact_type' => 'email',
                    'object_id' => $model->object_id,
                    'value' =>  $model->value . ' upd'
                ],
                [
                    'id' => $model->id,
                    'object_type' => 'organization',
                    'contact_type' => 'website',
                    'object_id' => $model->object_id,
                    'value' =>  $model->value . ' upd'
                ]
            ],
        ];

        return $rawData;

    }




}
