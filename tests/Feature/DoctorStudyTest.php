<?php

namespace Tests\Feature;

use App\Models\Master\Doctor\Doctor;
use App\Models\Master\DoctorStudy\DoctorStudy;
use App\Models\Master\Specialty\Specialty;
use App\Models\Master\SpecialtyType\SpecialtyType;
use App\Models\Master\StudyDegree\StudyDegree;
use App\Models\Master\StudyType\StudyType;
use App\Models\Master\University\University;

class DoctorStudyTest extends Base
{
    public function setUp() : void
    {
        $this->hasTranslation = false;
        $this->modelName = 'doctor-study';
        $this->modelClass = DoctorStudy::class;

        $this->singleStructure = [
            'id',
            'doctor_id',
            'study_type_id',
            'university_id',
            'study_degree_id',
            'specialty_id',
            'direction',
            'description',
            'began_year',
            'graduated_year',
            'created_by',
            'updated_by',
            'deleted_by',
            'updated_at',
            'created_at',
            'deleted_at',
            'doctor_study_type',
            'doctor_university',
            'doctor_study_degree',
            'doctor_specialty',
        ];

        $this->indexStructure = [
            '*' => [
                'id',
                'doctor_id',
                'study_type_id',
                'university_id',
                'study_degree_id',
                'specialty_id',
                'direction',
                'description',
                'began_year',
                'graduated_year',
                'created_by',
                'updated_by',
                'deleted_by',
                'updated_at',
                'created_at',
                'deleted_at',
                'doctor_study_type',
                'doctor_university',
                'doctor_study_degree',
                'doctor_specialty',
            ]
        ];

        $this->rawData = [
            "doctor_id" => 1,
            "study_type_id" => 1,
            "university_id" => 1,
            "study_degree_id" => 1,
            "specialty_id" => 1,
            "direction" => "Test direction",
            "description" => "Test description",
            "began_year" => 2015,
            "graduated_year" => 2019
        ];

        parent::setUp();
    }


    // create

    // create da agar header token berilsa va form ma'lumotlari jo'natilsa, 201 qaytishi kerak
    // qaytgan response strukturasi belgilangan strukturaga mos kelishi kk
    // qaytgan response tarkibida jo'natilgan ma'lumotlar bo'lishi kerak
    public function test_can_create_item()
    {
        $rawData = $this->getRawData();

        $this->json("post", route($this->modelName . '.store'), $rawData, $this->getHeadersWithToken())
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
        $rawData = $rawData2 = $rawData3 = $rawData4 = $this->getRawData();;
        unset($rawData['doctor_id']);
        unset($rawData2['study_type_id']);
        unset($rawData3['began_year']);
        unset($rawData4['graduated_year']);

        $this->json("post", route($this->modelName . '.store'), $rawData, $this->getHeadersWithToken())
            ->assertStatus(422);

        $this->json("post", route($this->modelName . '.store'), $rawData2, $this->getHeadersWithToken())
            ->assertStatus(422);

        $this->json("post", route($this->modelName . '.store'), $rawData3, $this->getHeadersWithToken())
            ->assertStatus(422);

        $this->json("post", route($this->modelName . '.store'), $rawData4, $this->getHeadersWithToken())
            ->assertStatus(422);
    }



    // update

    // update da agar header token berilsa va form ma'lumotlari jo'natilsa, 200 qaytishi kerak
    public function test_can_update_item()
    {
        $rawData = $this->getRawData();
        $model = DoctorStudy::factory()->create($rawData);

        $rawData['graduated_year'] = date('Y', strtotime('+1 year', strtotime($model->graduated_year)));

        $this->putJson(route($this->modelName . '.update', [$this->paramName => $model->id]), $rawData, $this->getHeadersWithToken())
            ->assertStatus(200);
    }

    // update da agar headerda token berilmasa, 401 qaytishi kerak
    public function test_return_unauthorized_error_when_token_is_wrong_on_update()
    {
        $rawData = $this->getRawData();
        $model = DoctorStudy::factory()->create($rawData);

        $rawData['graduated_year'] = date('Y', strtotime('+1 year', strtotime($model->graduated_year)));

        $this->putJson(route($this->modelName . '.update', [$this->paramName => $model->id]), $rawData)
            ->assertStatus(401);
    }

    // updateda agar required fieldlar jonatilmasa xato qaytishi kerak
    public function test_return_validation_error_without_sending_required_fields_on_update()
    {
        $rawData = $rawData2 = $rawData3 = $rawData4 = $this->getRawData();
        $model = DoctorStudy::factory()->create($rawData);
        unset($rawData['doctor_id']);
        unset($rawData2['study_type_id']);
        unset($rawData3['began_year']);
        unset($rawData4['graduated_year']);

        $this->putJson(route($this->modelName . '.update', [$this->paramName => $model->id]), $rawData, $this->getHeadersWithToken())
            ->assertStatus(422);

        $this->putJson(route($this->modelName . '.update', [$this->paramName => $model->id]), $rawData2, $this->getHeadersWithToken())
            ->assertStatus(422);

        $this->putJson(route($this->modelName . '.update', [$this->paramName => $model->id]), $rawData3, $this->getHeadersWithToken())
            ->assertStatus(422);

        $this->putJson(route($this->modelName . '.update', [$this->paramName => $model->id]), $rawData4, $this->getHeadersWithToken())
            ->assertStatus(422);
    }


    // index

    // index da agar headerda token berilsa,
    // required param bo'lgan language berilsa,
    // 200 qaytishi kerak
    public function test_can_index_items()
    {
        $rawData = $this->getRawData();
        DoctorStudy::factory()->create($rawData);

        $params = [
            'doctor_id' => $rawData['doctor_id'],
            'language' => 'uz'
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

    // agar indexda required paramlar berilmasa 422 qaytishi kerak
    public function test_return_validation_error_when_required_params_not_sent_on_index()
    {
        $doctor = Doctor::factory()->create();

        $params = [
            'language' => 'uz'
        ];

        $params2 = [
            'doctor_id' => $doctor->id,
        ];

        $this->getJson(route($this->modelName . '.index',$params), $this->getHeadersWithToken())
            ->assertStatus(422);

        $this->getJson(route($this->modelName . '.index',$params2), $this->getHeadersWithToken())
            ->assertStatus(422);
    }



    // delete

    // delete da agar header token berilsa 204 (NO CONTENT) status qaytishi kerak
    public function test_can_delete_item()
    {
        $rawData = $this->getRawData();
        $model = DoctorStudy::factory()->create($rawData);

        $this->deleteJson(route($this->modelName . '.destroy', [$this->paramName => $model->id]),[], $this->getHeadersWithToken())
            ->assertStatus(204);
    }

    // delete da agar headerda token berilmasa, 401 qaytishi kerak
    public function test_return_unauthorized_error_when_token_is_wrong_on_delete()
    {
        $rawData = $this->getRawData();
        $model = DoctorStudy::factory()->create($rawData);

        $this->deleteJson(route($this->modelName . '.destroy', [$this->paramName => $model->id]))
            ->assertStatus(401);
    }

    // delete da agar berilgan model_id topilmasa xato qaytishi kerak
    public function test_return_not_found_error_when_wrong_item_id_is_sent_on_delete()
    {
        $rawData = $this->getRawData();
        $model = DoctorStudy::factory()->create($rawData);

        $this->deleteJson(route($this->modelName . '.destroy', [$this->paramName => $model->id + 1]), $this->getHeadersWithToken())
            ->assertStatus(404);
    }


    // show

    // show da agar header token berilsa 200 qaytishi kerak
    // qaytgan response strukturasi belgilangan strukturaga mos kelishi kk
    // qaytgan response tarkibida jo'natilgan ma'lumotlar bo'lishi kerak
    public function test_can_show_item()
    {
        $rawData = $this->getRawData();
        $model = DoctorStudy::factory()->create($rawData);

        $params = [
            $this->paramName => $model->id,
            'language' => 'uz',
        ];

        $data = [
            'id' => $model->id,
        ];

        $this->getJson(route($this->modelName . '.show', $params), $this->getHeadersWithToken())
            ->assertStatus(200)
            ->assertJsonStructure($this->singleStructure)
            ->assertJsonFragment($data);
    }

    // show da agar headerda token berilmasa, 401 qaytishi kerak
    public function test_return_unauthorized_error_when_token_is_wrong_on_show()
    {
        $rawData = $this->getRawData();
        $model = DoctorStudy::factory()->create($rawData);

        $this->getJson(route($this->modelName . '.show', [$this->paramName => $model->id]))
            ->assertStatus(401);
    }

    // show da agar berilgan model_id topilmasa xato qaytishi kerak
    public function test_return_not_found_error_when_wrong_item_id_is_sent_on_show()
    {
        $rawData = $this->getRawData();
        $model = DoctorStudy::factory()->create($rawData);

        $params = [
            $this->paramName => $model->id + 1,
            'language' => 'uz',
        ];

        $this->getJson(route($this->modelName . '.show', $params), $this->getHeadersWithToken())
            ->assertStatus(404);
    }

    // show da agar language field bolmasa xato bersin
    public function test_return_validation_error_when_language_not_sent_on_show()
    {
        $rawData = $this->getRawData();
        $model = DoctorStudy::factory()->create($rawData);

        $params = [
            $this->paramName => $model->id,
        ];

        $this->getJson(route($this->modelName . '.show', $params), $this->getHeadersWithToken())
            ->assertStatus(422);
    }





    protected function getRawData(){
        $doctor = Doctor::factory()->create();
        $studyType = StudyType::factory()->create();
        $university = University::factory()->create();
        $studyDegree = StudyDegree::factory()->create();

        $specialtyType = SpecialtyType::factory()->create();
        $specialty = Specialty::factory()->create(['specialty_type_id' => $specialtyType->id]);

        $rawData = $this->rawData;
        $rawData['doctor_id'] = $doctor->id;
        $rawData['study_type_id'] = $studyType->id;
        $rawData['university_id'] = $university->id;
        $rawData['study_degree_id'] = $studyDegree->id;
        $rawData['specialty_id'] = $specialty->id;

        return $rawData;
    }


}
