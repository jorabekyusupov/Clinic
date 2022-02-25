<?php

namespace Tests\Feature;

use App\Models\Master\Language\Language;
use App\Models\Master\Person\Person;

class LanguageTest extends Base
{
    public function setUp() : void
    {
        $this->hasTranslation = false;
        $this->modelName = 'language';
        $this->modelClass = Language::class;

        $this->singleStructure = [
            'id',
            'code',
            'name',
            'is_active',
            'created_at',
            'updated_at',
            'created_by',
            'updated_by'
        ];

        $this->indexStructure = [
            '*' => [
                'id',
                'code',
                'name'
            ]
        ];

        $this->rawData = [
            'name' => 'New lang',
            'code' => 'nl',
            'is_active' => 1
        ];

        parent::setUp();
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
        $rawData = $rawData2 = $rawData3 = $this->rawData;
        unset($rawData['name']);
        unset($rawData2['code']);
        unset($rawData3['is_active']);

        $this->json("post", route($this->modelName . '.store'), $rawData, $this->getHeadersWithToken())
            ->assertStatus(422);

        $this->json("post", route($this->modelName . '.store'), $rawData2, $this->getHeadersWithToken())
            ->assertStatus(422);

        $this->json("post", route($this->modelName . '.store'), $rawData3, $this->getHeadersWithToken())
            ->assertStatus(422);
    }

    // create da unique fieldarni qayta post qilinsa xato qaytishi kerak
    public function test_return_validation_error_when_send_dublicate_data_on_create()
    {
        $model = $this->createModels()[0];
        $rawData = $this->rawData;
        $rawData['code'] = $model->code;

        $this->json("post", route($this->modelName . '.store'), $rawData, $this->getHeadersWithToken())
            ->assertStatus(422);
    }



    // update

    // update da agar header token berilsa va form ma'lumotlari jo'natilsa, 200 qaytishi kerak
    public function test_can_update_item()
    {
        $model = $this->createModels()[0];
        $rawData = [
            'code' => $model->code,
            'name' => $model->name . ' upd',
            'is_active' => $model->is_active
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
            'code' => $model->code,
            'name' => $model->name,
            'is_active' => $model->is_active
        ];

        $this->putJson(route($this->modelName . '.update', [$this->modelName => $model->id]), $rawData, $this->getHeadersWithToken())
            ->assertStatus(200);
    }

    // updateda agar required fieldlar jonatilmasa xato qaytishi kerak
    public function test_return_validation_error_without_sending_required_fields_on_update()
    {
        $model = $this->createModels()[0];

        $rawData = [
            'code' => $model->code,
            'name' => $model->name
        ];

        $rawData2 = [
            'name' => $model->name,
            'is_active' => $model->is_active
        ];

        $rawData3 = [
            'code' => $model->code,
            'is_active' => $model->is_active
        ];

        $this->putJson(route($this->modelName . '.update', [$this->modelName => $model->id]), $rawData, $this->getHeadersWithToken())
            ->assertStatus(422);

        $this->putJson(route($this->modelName . '.update', [$this->modelName => $model->id]), $rawData2, $this->getHeadersWithToken())
            ->assertStatus(422);

        $this->putJson(route($this->modelName . '.update', [$this->modelName => $model->id]), $rawData3, $this->getHeadersWithToken())
            ->assertStatus(422);
    }


    // index

    // index da agar headerda token berilsa,
    // required param bo'lgan language berilsa,
    // 200 qaytishi kerak
    public function test_can_index_items()
    {
        $this->createModels(1);

        $this->getJson(route($this->modelName . '.index',['search' => '']), $this->getHeadersWithToken())
            ->assertStatus(200)
            ->assertJsonStructure($this->indexStructure);
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
        ];

        $this->getJson(route($this->modelName . '.show', $params), $this->getHeadersWithToken())
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

}
