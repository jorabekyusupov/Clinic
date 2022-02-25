<?php

namespace Tests\Feature;

use App\Models\Master\ContentWord\ContentWord;
use App\Models\Master\ContentWord\ContentWordTranslation;

class ContentWordTest extends Base
{
    public function setUp() : void
    {
        $this->modelName = 'content-word';
        $this->modelClass = ContentWord::class;
        $this->modelTranslationClass = ContentWordTranslation::class;

        parent::setUp();

        $this->singleStructure = [
            'id',
            'word',
            'status',
            'created_at',
            'updated_at',
            'created_by',
            'updated_by',
            'deleted_by',
            'deleted_at',
            'translations' => [
                '*' => [
                    'id',
                    'content_word_id',
                    'language_code',
                    'translation',
                    'language'
                ]
            ]
        ];

        $this->indexStructure = [
            '*' => [
                'id',
                'word',
                'status',
                'created_by',
                'created_at',
                'created_at',
                'updated_by',
                'updated_at',
                'deleted_by',
                'deleted_at',
                'content_word_translation_id',
                'content_word_id',
                'language_code',
                'translation',
            ]
        ];

        $this->listStructure = [
            'current_page',
            'data' => [
                '*' => [
                    'id',
                    'word',
                    'status',
                    'created_by',
                    'created_at',
                    'created_at',
                    'updated_by',
                    'updated_at',
                    'deleted_by',
                    'deleted_at',
                    'content_word_translation_id',
                    'content_word_id',
                    'language_code',
                    'translation',
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
            'word' => 'Test content_word',
            'status' => 1,
            'translations' => [
                [
                    'language_code' => 'ru',
                    'name' => 'Test content_word ru',
                ],
                [
                    'language_code' => 'uz',
                    'name' => 'Test content_word uz',
                ],
                [
                    'language_code' => 'uzc',
                    'name' => 'Test content_word uzc',
                ]
            ],
        ];

        $this->listFormData = [
            'language' => 'ru',
            'originalEvent' => [
                'page' => 0,
                'rows' => 20,
                'multiSortMeta' => null,
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
        unset($rawData['word']);

        $this->json("post", route($this->modelName . '.store'), $rawData, $this->getHeadersWithToken())
            ->assertStatus(422);

        $rawData2 = $this->rawData;
        unset($rawData2['status']);

        $this->json("post", route($this->modelName . '.store'), $rawData2, $this->getHeadersWithToken())
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


    // create da unique fieldarni qayta post qilinsa xato qaytishi kerak
    public function test_return_validation_error_when_send_dublicate_data_on_create()
    {
        $model = $this->createModels()[0];

        $rawData = $this->rawData;
        $rawData['word'] = $model->word;

        $this->json("post", route($this->modelName . '.store'), $rawData, $this->getHeadersWithToken())
            ->assertStatus(422);
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
        $rawData = $rawData2 = $this->prepareDataForUpdate($model);
        unset($rawData['status']);
        unset($rawData2['word']);

        $this->putJson(route($this->modelName . '.update', [$this->paramName => $model->id]), $rawData, $this->getHeadersWithToken())
            ->assertStatus(422);

        $this->putJson(route($this->modelName . '.update', [$this->paramName => $model->id]), $rawData, $this->getHeadersWithToken())
            ->assertStatus(422);
    }

    // update da agar berilgan item_id topilmasa xato qaytishi kerak
    public function test_return_not_found_error_when_wrong_item_id_is_sent_on_update()
    {
        $model = $this->createModels()[0];
        $rawData = $this->prepareDataForUpdate($model);

        $this->putJson(route($this->modelName . '.update', [$this->paramName => $model->id + 1]), $rawData, $this->getHeadersWithToken())
            ->assertStatus(404);
    }

    // updateda agar unique fieldlarni o'zgartirmasdan jo'natilsa xato qaytmasligi kerak
    public function test_can_update_item_with_not_changed_unique_fields_on_update()
    {
        $model = $this->createModels()[0];
        $rawData = $this->prepareDataForUpdate($model);
        $rawData['word'] = $model->word;
        $rawData['status'] = $model->status;

        $this->putJson(route($this->modelName . '.update', [$this->paramName => $model->id]), $rawData, $this->getHeadersWithToken())
            ->assertStatus(200);
    }




    // index

    // index da agar headerda token berilsa,
    // required param bo'lgan language berilsa,
    // 200 qaytishi kerak
    public function test_can_index_items()
    {
        $this->createModels(3);

        $this->getJson(route($this->modelName . '.index',['language' => 'uz', 'search' => '']), $this->getHeadersWithToken())
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



    // list

    // list da agar headerda token berilsa,
    // required param bo'lgan language berilsa,
    // 200 qaytishi kerak
    public function test_can_list_items()
    {
        $this->createModels(3);

        $this->postJson(route($this->modelNamePlural . '.list'), $this->listFormData, $this->getHeadersWithToken())
            ->assertStatus(200)
            ->assertJsonStructure($this->listStructure);
    }

    // list da agar headerda token berilmasa, 401 qaytishi kerak
    public function test_return_unauthorized_error_when_token_is_wrong_on_list()
    {
        $this->createModels(3);
        $this->postJson(route($this->modelNamePlural . '.list'), $this->listFormData)
            ->assertStatus(401);
    }

    // list da agar headerda token berilsa va language berilmasa 422 qaytishi kerak
    public function test_return_validation_error_when_language_param_not_sent_on_list()
    {
        $this->createModels(3);
        $formData = $this->listFormData;
        unset($formData['language']);
        $this->postJson(route($this->modelNamePlural . '.list'), $formData, $this->getHeadersWithToken())
            ->assertStatus(422);
    }


    private function prepareDataForUpdate($model){

        $translations = [];
        foreach ($model->translations as $tr) {
            $translations[] = [
                'id' => $tr->id,
                'content_word_id' => $model->id,
                'translation' => $tr->translation . ' updated',
                'language_code' => $tr->language_code
            ];
        }

        $rawData = [
            'word' => $model->word . ' updated',
            'status' => $model->status,
            'translations' => $translations
        ];

        return $rawData;

    }




}
