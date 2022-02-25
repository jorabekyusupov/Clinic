<?php

namespace Tests\Feature;

use App\Models\Master\Person\Person;

class PersonTest extends Base
{
    public function setUp() : void
    {
        $this->hasTranslation = false;
        $this->modelName = 'person';
        $this->modelClass = Person::class;

        $this->singleStructure = [
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
        ];

        $this->rawData = [
            'last_name' => 'Test last name',
            'first_name' => 'Test first name',
            'middle_name' => 'Test middle name',
            'born_date' => '1992-01-01',
            'jshshir' => 12345678901234,
            'gender' => 'M'
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
        $rawData = $this->rawData;
        unset($rawData['first_name']);

        $this->json("post", route($this->modelName . '.store'), $rawData, $this->getHeadersWithToken())
            ->assertStatus(422);
    }



    // update

    // update da agar header token berilsa va form ma'lumotlari jo'natilsa, 200 qaytishi kerak
    public function test_can_update_item()
    {
        $model = $this->createModels()[0];
        $rawData = [
            'last_name' => $model->last_name . ' upd',
            'first_name' => $model->first_name . ' upd',
            'middle_name' => $model->middle_name . ' upd',
            'born_date' => '1992-01-01',
            'jshshir' => 77987987989,
            'gender' => 'F'
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

    // updateda agar required fieldlar jonatilmasa xato qaytishi kerak
    public function test_return_validation_error_without_sending_required_fields_on_update()
    {
        $model = $this->createModels()[0];
        $rawData = $this->rawData;
        unset($rawData['first_name']);

        $this->putJson(route($this->modelName . '.update', [$this->modelName => $model->id]), $rawData, $this->getHeadersWithToken())
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

    // jshshir

    // jshshir da agar header token berilsa 200 qaytishi kerak
    // qaytgan response strukturasi belgilangan strukturaga mos kelishi kk
    // qaytgan response tarkibida jo'natilgan ma'lumotlar bo'lishi kerak
    public function test_can_jshshir_item()
    {
        $model = $this->createModels()[0];

        $data = [
            'id' => $model->id,
        ];

        $params = [
            'jshshir' => $model->jshshir,
        ];

        $this->getJson(route('people.jshshir', $params), $this->getHeadersWithToken())
            ->assertStatus(200)
            ->assertJsonStructure($this->singleStructure)
            ->assertJsonFragment($data);
    }

    // jshshir da agar headerda token berilmasa, 401 qaytishi kerak
    public function test_return_unauthorized_error_when_token_is_wrong_on_jshshir()
    {
        $model = $this->createModels()[0];

        $this->getJson(route('people.jshshir', ['jshshir' => $model->jshshir]))
            ->assertStatus(401);
    }

    // jshshir da agar berilgan model_id topilmasa xato qaytishi kerak
    public function test_return_not_found_error_when_wrong_item_id_is_sent_on_jshshir()
    {
        $model = $this->createModels()[0];
        $params = [
            'jshshir' => $model->jshshir . 'XXX',
        ];
        $this->getJson(route('people.jshshir', $params), $this->getHeadersWithToken())
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
