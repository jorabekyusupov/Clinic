<?php

namespace Tests\Feature;

use App\Models\Master\Person\Person;
use App\Models\Master\Role\Role;
use App\Models\Master\Role\RoleTranslation;
use App\Models\Master\User\User;
use Laravel\Passport\Passport;

class UserTest extends Base
{
    public function setUp() : void
    {
        $this->hasTranslation = false;
        $this->modelName = 'user';
        $this->modelClass = User::class;

        $this->indexStructure = [
            'current_page',
            'data' => [
                '*' => [
                    'id',
                    'username',
                    'email',
                    'email_verified_at',
                    'status',
                    'created_at',
                    'updated_at',
                    'deleted_at',
                    'person_id',
                    'created_by',
                    'updated_by',
                    'deleted_by',
                    'person' => [
                        'id',
                        'first_name',
                        'last_name',
                        'middle_name',
                    ],
                    'roles',
                    'permissions',
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

        $this->singleStructure = [
            'id',
            'username',
            'email',
            'email_verified_at',
            'status',
            'created_at',
            'updated_at',
            'deleted_at',
            'person_id',
            'created_by',
            'updated_by',
            'deleted_by',
        ];

        $this->rawData = [
            'username' => 'testuser',
            'email' => 'test@test.com',
            'password' => '123456',
        ];

        $this->listFormData = [
            'language' => 'ru',
            'originalEvent' => [
                'page' => 0,
                'rows' => 20,
                'multiSortMeta' => null,
            ],
        ];

        parent::setUp();
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

    // show profile
    public function test_can_show_profile_item()
    {
        Passport::actingAs($this->user);
        $user = auth()->user();
        $data = [
            'id' => $user->id,
            'username' => $user->username,
        ];


        $this->getJson(route($this->modelNamePlural . '.profile'), $this->getHeadersWithToken())
            ->assertStatus(200)
            ->assertJsonStructure($this->singleStructure)
            ->assertJsonFragment($data);
    }

    // profile da agar headerda token berilmasa, 401 qaytishi kerak
    public function test_return_unauthorized_error_when_token_is_wrong_on_profile()
    {
        $this->getJson(route($this->modelNamePlural . '.profile'))
            ->assertStatus(401);
    }

    // index

    // index da agar headerda token berilsa,
    // required param bo'lgan language berilsa,
    // 200 qaytishi kerak
    public function test_can_index_items()
    {
        $this->createModels(1);

        $this->getJson(route($this->modelName . '.index'), $this->getHeadersWithToken())
            ->assertStatus(200)
            ->assertJsonStructure($this->indexStructure);
    }

    // index da agar headerda token berilmasa, 401 qaytishi kerak
    public function test_return_unauthorized_error_when_token_is_wrong_on_index()
    {
        $this->getJson(route($this->modelName . '.index'))
            ->assertStatus(401);
    }


    // update role

    // update role
    public function test_can_update_role()
    {
        $params = $this->getParams();

        $this->postJson(route($this->modelNamePlural . '.update-role', $params), $this->getHeadersWithToken())
            ->assertStatus(200);
    }

    // update role wrong token
    public function test_return_unauthorized_error_when_token_is_wrong_on_update_role()
    {
        $params = $this->getParams();

        $this->postJson(route($this->modelNamePlural . '.update-role', $params))
            ->assertStatus(401);
    }

    // update role
    public function test_return_validation_error_when_required_fields_not_sent_on_update_role()
    {
        $params = $params2 = $params3 = $this->getParams();
        unset($params['user_id']);
        unset($params2['role_id']);
        unset($params3['type']);

        $this->postJson(route($this->modelNamePlural . '.update-role', $params), $this->getHeadersWithToken())
            ->assertStatus(422);
        $this->postJson(route($this->modelNamePlural . '.update-role', $params2), $this->getHeadersWithToken())
            ->assertStatus(422);
        $this->postJson(route($this->modelNamePlural . '.update-role', $params3), $this->getHeadersWithToken())
            ->assertStatus(422);
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

        $this->postJson(route($this->modelNamePlural . '.list'), $this->listFormData, $this->getHeadersWithToken())
            ->assertStatus(200)
            ->assertJsonStructure($this->listStructure);
    }

    // list da agar headerda token berilmasa, 401 qaytishi kerak
    public function test_return_unauthorized_error_when_token_is_wrong_on_list()
    {
        $this->createModels(1);
        $this->postJson(route($this->modelNamePlural . '.list'), $this->listFormData)
            ->assertStatus(401);
    }

    // list da agar headerda token berilsa va language berilmasa 422 qaytishi kerak
    public function test_return_validation_error_when_language_param_not_sent_on_list()
    {
        $this->createModels(1);
        $formData = $this->listFormData;
        unset($formData['language']);
        $this->postJson(route($this->modelNamePlural . '.list'), $formData, $this->getHeadersWithToken())
            ->assertStatus(422);
    }

    protected function createModels($count = 1){

        $person = Person::factory()->create();
        $users = $this->modelClass::factory($count)->create(['person_id' => $person->id]);
        return $users;
    }

    protected function getParams($type = 'role'){

        $user = $this->createModels()[0];
        $class = 'App\Models\Master\Role\\'.ucfirst($type).'Translation';
        $class2 = 'App\Models\Master\Role\\'.ucfirst($type);
        $model = $class2::factory()->create();
       $class::factory()->create([$type.'_id' => $model->id, 'language_code' => 'uz']);
        $class::factory()->create([$type.'_id' => $model->id, 'language_code' => 'uzc']);
        $class::factory()->create([$type.'_id' => $model->id, 'language_code' => 'ru']);

        $params = [
            'user_id' => $user->id,
            $type.'_id' => $model->id,
            'type' => 1
        ];

        return $params;
    }

}
