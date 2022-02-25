<?php

namespace Tests\Feature;

use App\Models\Master\Doctor\Doctor;
use App\Models\Master\Person\Person;

class DoctorTest extends Base
{
    public function setUp() : void
    {
        $this->hasTranslation = false;
        $this->modelName = 'doctor';
        $this->modelClass = Doctor::class;

        $this->singleStructure = [
            'id',
            'person_id',
            'status',
            'specialties',
            'created_at',
            'updated_at',
            'created_by',
            'updated_by',
            'deleted_by',
            'deleted_at',
            'person' => [
                'id',
                'first_name',
                'last_name',
                'middle_name',
                'born_date',
                'jshshir',
                'gender',
                'created_at',
                'created_by',
                'updated_at',
                'updated_by',
                'deleted_at',
                'deleted_by',
            ]
        ];

        $this->indexStructure = [
            'current_page',
            'data' => [
                '*' => [
                    'id',
                    'person_id',
                    'status',
                    'default_picture',
                    'created_at',
                    'updated_at',
                    'created_by',
                    'updated_by',
                    'deleted_by',
                    'deleted_at',
                    'person' => [
                        'id',
                        'first_name',
                        'last_name',
                        'middle_name',
                        'born_date',
                        'jshshir',
                        'gender',
                        'created_at',
                        'created_by',
                        'updated_at',
                        'updated_by',
                        'deleted_at',
                        'deleted_by',
                    ]
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

        $this->listStructure = [
            'current_page',
            'data' => [
                '*' => [
                    'id',
                    'person_id',
                    'status',
                    'default_picture',
                    'contacts',
                    'work_schedules',
                    'specialties',
                    'created_at',
                    'updated_at',
                    'created_by',
                    'updated_by',
                    'deleted_by',
                    'deleted_at',
                    'person' => [
                        'id',
                        'first_name',
                        'last_name',
                        'middle_name'
                    ]
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
            'status' => 1,
            'person_id' => 101
        ];

        $this->formData = [
            'language' => 'ru',
            'originalEvent' => [
                'page' => 0,
                'rows' => 20,
                'multiSortMeta' => null,
            ],
        ];

        parent::setUp();
    }


    // create

    // create da agar header token berilsa va form ma'lumotlari jo'natilsa, 201 qaytishi kerak
    // qaytgan response strukturasi belgilangan strukturaga mos kelishi kk
    // qaytgan response tarkibida jo'natilgan ma'lumotlar bo'lishi kerak
    public function test_can_create_item()
    {
        $person = Person::factory()->create();
        $this->rawData['person_id'] = $person->id;

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
        unset($rawData['status']);
        unset($rawData2['person_id']);

        $this->json("post", route($this->modelName . '.store'), $rawData, $this->getHeadersWithToken())
            ->assertStatus(422);

        $this->json("post", route($this->modelName . '.store'), $rawData2, $this->getHeadersWithToken())
            ->assertStatus(422);
    }

    // create da unique fieldarni qayta post qilinsa xato qaytishi kerak
    public function test_return_validation_error_when_send_dublicate_data_on_create()
    {
        $model = $this->createModels()[0];
        $rawData = $this->rawData;
        $rawData['person_id'] = $model->person_id;

        $this->json("post", route($this->modelName . '.store'), $rawData, $this->getHeadersWithToken())
            ->assertStatus(422);
    }



    // update

    // update da agar header token berilsa va form ma'lumotlari jo'natilsa, 200 qaytishi kerak
    public function test_can_update_item()
    {
        $model = $this->createModels()[0];
        $person = Person::factory()->create();
        $rawData = [
            'person_id' => $person->id,
            'status' => $model->status
        ];

        $this->putJson(route($this->modelName . '.update', [$this->modelName => $model->id]), $rawData, $this->getHeadersWithToken())
            ->assertStatus(200);
    }

    // update da agar headerda token berilmasa, 401 qaytishi kerak
    public function test_return_unauthorized_error_when_token_is_wrong_on_update()
    {
        $model = $this->createModels()[0];
        $rawData =[];

        $this->putJson(route($this->modelName . '.update', [$this->modelName => $model->id]), $rawData)
            ->assertStatus(401);
    }

    // updateda agar unique fieldlarni o'zgartirmasdan jo'natilsa xato qaytmasligi kerak
    public function test_can_update_item_with_not_changed_unique_fields_on_update()
    {
        $model = $this->createModels()[0];
        $rawData = [
            'person_id' => $model->person_id,
            'status' => $model->status
        ];

        $this->putJson(route($this->modelName . '.update', [$this->modelName => $model->id]), $rawData, $this->getHeadersWithToken())
            ->assertStatus(200);
    }

    // updateda agar required fieldlar jonatilmasa xato qaytishi kerak
    public function test_return_validation_error_without_sending_required_fields_on_update()
    {
        $model = $this->createModels()[0];
        $person = Person::factory()->create();

        $rawData = [
            'person_id' => $person->id,
        ];

        $rawData2 = [
            'status' => $model->status
        ];

        $this->putJson(route($this->modelName . '.update', [$this->modelName => $model->id]), $rawData, $this->getHeadersWithToken())
            ->assertStatus(422);

        $this->putJson(route($this->modelName . '.update', [$this->modelName => $model->id]), $rawData2, $this->getHeadersWithToken())
            ->assertStatus(422);
    }


    // index

    // index da agar headerda token berilsa,
    // required param bo'lgan language berilsa,
    // 200 qaytishi kerak
    public function test_can_index_items()
    {
        $this->withoutExceptionHandling();
        $this->createModels(1);

        $this->getJson(route($this->modelName . '.index',['search' => '']), $this->getHeadersWithToken())
            ->assertStatus(200)
            ->assertJsonStructure($this->indexStructure);
    }

    // index da agar headerda token berilmasa, 401 qaytishi kerak
    public function test_return_unauthorized_error_when_token_is_wrong_on_index()
    {
        $this->getJson(route($this->modelName . '.index'))
            ->assertStatus(401);
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

        $params = [
            $this->modelName => $model->id,
            'language' => 'uz',
            'object_type' => 'doctor'
        ];

        $params2 = [
            $this->modelName => $model->person_id,
            'language' => 'uz',
            'object_type' => 'person'
        ];

        $this->getJson(route($this->modelName . '.show', $params), $this->getHeadersWithToken())
            ->assertStatus(200)
            ->assertJsonStructure($this->singleStructure)
            ->assertJsonFragment($data);

        $this->getJson(route($this->modelName . '.show', $params2), $this->getHeadersWithToken())
            ->assertStatus(200)
            ->assertJsonStructure($this->singleStructure)
            ->assertJsonFragment($data);
    }

    // show da agar headerda token berilmasa, 401 qaytishi kerak
    public function test_return_unauthorized_error_when_token_is_wrong_on_show()
    {
        $model = $this->createModels()[0];

        $this->getJson(route($this->modelName . '.show', [$this->modelName => $model->id]))
            ->assertStatus(401);
    }

    // show da agar berilgan model_id topilmasa xato qaytishi kerak
    public function test_return_not_found_error_when_wrong_item_id_is_sent_on_show()
    {
        $model = $this->createModels()[0];
        $params = [
            $this->modelName => $model->id + 1,
            'language' => 'uz',
            'object_type' => 'doctor'
        ];
        $this->getJson(route($this->modelName . '.show', $params), $this->getHeadersWithToken())
            ->assertStatus(404);
    }



    // delete

    // delete da agar header token berilsa 204 (NO CONTENT) status qaytishi kerak
    public function test_can_delete_item()
    {
        $model = $this->createModels()[0];

        $this->deleteJson(route($this->modelName . '.destroy', [$this->modelName => $model->id]),[], $this->getHeadersWithToken())
            ->assertStatus(204);
    }

    // delete da agar headerda token berilmasa, 401 qaytishi kerak
    public function test_return_unauthorized_error_when_token_is_wrong_on_delete()
    {
        $model = $this->createModels()[0];

        $this->deleteJson(route($this->modelName . '.destroy', [$this->modelName => $model->id]))
            ->assertStatus(401);
    }

    // delete da agar berilgan model_id topilmasa xato qaytishi kerak
    public function test_return_not_found_error_when_wrong_item_id_is_sent_on_delete()
    {
        $model = $this->createModels()[0];
        $this->deleteJson(route($this->modelName . '.destroy', [$this->modelName => $model->id + 1]), $this->getHeadersWithToken())
            ->assertStatus(404);
    }



    // list

    // list da agar headerda token berilsa,
    // required param bo'lgan language berilsa,
    // 200 qaytishi kerak
    public function test_can_list_items()
    {
        $this->createModels(1);

        $this->postJson(route($this->modelNamePlural . '.list'), $this->formData, $this->getHeadersWithToken())
            ->assertStatus(200)
            ->assertJsonStructure($this->listStructure);
    }

    // list da agar headerda token berilsa va language berilmasa 422 qaytishi kerak
    public function test_return_validation_error_when_language_param_not_sent_on_list()
    {
        $this->createModels(1);
        $formData = $this->formData;
        unset($formData['language']);
        $this->postJson(route($this->modelNamePlural . '.list'), $formData, $this->getHeadersWithToken())
            ->assertStatus(422);
    }

    // list da agar headerda token berilmasa, 401 qaytishi kerak
    public function test_return_unauthorized_error_when_token_is_wrong_on_list()
    {
        $this->createModels(1);
        $this->postJson(route($this->modelNamePlural . '.list'), $this->formData)
            ->assertStatus(401);
    }
}
