<?php

namespace Tests\Feature;

use App\Models\Master\WorkCalendar\WorkCalendar;
use App\Models\Master\WorkCalendarTranslation;

class WorkCalendarTest extends Base
{
    public function setUp() : void
    {
        $this->hasTranslation = false;
        $this->modelName = 'work-calendar';
        $this->modelClass = WorkCalendar::class;
        $this->modelTranslationClass = WorkCalendarTranslation::class;

        parent::setUp();

        $this->singleStructure = [
            'id',
            'calendar_date',
            'work_day_sequence',
            'is_work_day',
            'is_weekend',
            'is_holiday',
            'holiday_name',
        ];

        $this->indexStructure = [
            'current_page',
            'data' => [
                '*' => [
                    'id',
                    'calendar_date',
                    'work_day_sequence',
                    'is_work_day',
                    'is_weekend',
                    'is_holiday',
                    'holiday_name',
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

        $this->listStructure = $this->indexStructure;

        $this->rawData = [
            'calendar_date' => date('Y-m-d'),
            'work_day_sequence' => 1,
            'is_work_day' => true,
            'is_weekend' => false,
            'is_holiday' => false,
            'holiday_name' => 'Test text',
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
        unset($rawData['calendar_date']);

        $this->json("post", route($this->modelName . '.store'), $rawData, $this->getHeadersWithToken())
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

        // dd($this->getJson(route($this->modelName . '.show', [$this->paramName => $model->id]), $this->getHeadersWithToken()));

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

        $this->postJson(route($this->modelName . '.list'), $this->listFormData, $this->getHeadersWithToken())
            ->assertStatus(200)
            ->assertJsonStructure($this->listStructure);
    }

    // list da agar headerda token berilmasa, 401 qaytishi kerak
    public function test_return_unauthorized_error_when_token_is_wrong_on_list()
    {
        $this->createModels(3);
        $this->postJson(route($this->modelName . '.list'), $this->listFormData)
            ->assertStatus(401);
    }

    // list da agar headerda token berilsa va language berilmasa 422 qaytishi kerak
    public function test_return_validation_error_when_language_param_not_sent_on_list()
    {
        $this->createModels(3);
        $formData = $this->listFormData;
        unset($formData['language']);
        $this->postJson(route($this->modelName . '.list'), $formData, $this->getHeadersWithToken())
            ->assertStatus(422);
    }

    protected function createModels($count = 1){

        $models = $this->modelClass::factory($count)->create();
        return $models;
    }


    private function prepareDataForUpdate($model){

        $rawData = [
            'calendar_date' => $model->calendar_date,
            'work_day_sequence' => $model->work_day_sequence,
            'is_work_day' => !$model->is_work_day,
            'is_weekend' => $model->is_weekend,
            'is_holiday' => !$model->is_holiday,
            'holiday_name' => $model->holiday_name . ' updated',
        ];

        return $rawData;

    }




}
