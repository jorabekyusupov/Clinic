<?php

namespace Tests\Feature;

use App\Models\Master\Person\Person;
use App\Models\Master\User\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Illuminate\Support\Str;
use Laravel\Passport\Passport;

class Base extends TestCase
{
    use RefreshDatabase;

    protected $singleStructure;
    protected $indexStructure;
    protected $modelName;
    protected $modelNamePlural;
    protected $modelClass;
    protected $paramName;
    protected $user;
    protected $rawData;
    protected $hasTranslation = true;


    public function setUp() : void
    {
        parent::setUp();

        $this->artisan('passport:install', ['--no-interaction' => true]);

        $this->modelNamePlural = Str::plural($this->modelName);
        $this->paramName = Str::snake(Str::camel($this->modelName));

        $person = Person::factory()->create();
        $this->user = User::factory()->create(['person_id' => $person->id]);


    }

    protected function getHeadersWithToken(){

        Passport::actingAs($this->user);
        $token = $this->user->createToken('Test token')->accessToken;
        return ['Authorization' => 'Bearer '. $token];

    }

    protected function createModels($count = 1){

        $params = [
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

}
