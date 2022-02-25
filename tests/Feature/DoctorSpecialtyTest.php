<?php

namespace Tests\Feature;

use App\Models\Master\Doctor\Doctor;
use App\Models\Master\DoctorSpecialty\DoctorSpecialty;
use App\Models\Master\Specialty\Specialty;
use App\Models\Master\SpecialtyType\SpecialtyType;

class DoctorSpecialtyTest extends Base
{
    public function setUp() : void
    {
        $this->hasTranslation = false;
        $this->modelName = 'doctor-specialty';
        $this->modelClass = DoctorSpecialty::class;

        $this->indexStructure = [
            '*' => [
                'id',
                'doctor_id',
                'specialty_id',
                'certificate_taken_date',
                'certificate_due_date',
                'created_by',
                'updated_by',
                'deleted_by',
                'updated_at',
                'created_at',
                'deleted_at',
                'specialty'
            ]
        ];

        $this->rawData = [
            'doctor_id' => 1,
            'specialty_id' => 1
        ];

        parent::setUp();
    }


    // create

    // create da agar header token berilsa va form ma'lumotlari jo'natilsa, 201 qaytishi kerak
    // qaytgan response strukturasi belgilangan strukturaga mos kelishi kk
    // qaytgan response tarkibida jo'natilgan ma'lumotlar bo'lishi kerak
    public function test_can_create_item()
    {
        $doctor = Doctor::factory()->create();
        $specialtyType = SpecialtyType::factory()->create();
        $specialty = Specialty::factory()->create(['specialty_type_id' => $specialtyType->id]);
        $this->rawData['doctor_id'] = $doctor->id;
        $this->rawData['specialty_id'] = $specialty->id;

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
        unset($rawData['doctor_id']);
        unset($rawData2['specialty_id']);

        $this->json("post", route($this->modelName . '.store'), $rawData, $this->getHeadersWithToken())
            ->assertStatus(422);

        $this->json("post", route($this->modelName . '.store'), $rawData2, $this->getHeadersWithToken())
            ->assertStatus(422);
    }

    // create da unique fieldarni qayta post qilinsa xato qaytishi kerak
    public function test_return_validation_error_when_send_dublicate_data_on_create()
    {
        $doctor = Doctor::factory()->create();
        $specialtyType = SpecialtyType::factory()->create();
        $specialty = Specialty::factory()->create(['specialty_type_id' => $specialtyType->id]);
        $this->rawData['doctor_id'] = $doctor->id;
        $this->rawData['specialty_id'] = $specialty->id;

        DoctorSpecialty::factory()->create($this->rawData);

        $this->json("post", route($this->modelName . '.store'), $this->rawData, $this->getHeadersWithToken())
            ->assertStatus(422);
    }



    // update

    // update da agar header token berilsa va form ma'lumotlari jo'natilsa, 200 qaytishi kerak
    public function test_can_update_item()
    {
        $doctor = Doctor::factory()->create();
        $specialtyType = SpecialtyType::factory()->create();
        $specialty = Specialty::factory()->create(['specialty_type_id' => $specialtyType->id]);
        $this->rawData['doctor_id'] = $doctor->id;
        $this->rawData['specialty_id'] = $specialty->id;

        $model = DoctorSpecialty::factory()->create($this->rawData);

        $specialty2 = Specialty::factory()->create(['specialty_type_id' => $specialtyType->id]);
        $this->rawData['doctor_id'] = $doctor->id;
        $this->rawData['specialty_id'] = $specialty2->id;

        $this->putJson(route($this->modelName . '.update', [$this->paramName => $model->id]), $this->rawData, $this->getHeadersWithToken())
            ->assertStatus(200);
    }

    // update da agar headerda token berilmasa, 401 qaytishi kerak
    public function test_return_unauthorized_error_when_token_is_wrong_on_update()
    {
        $doctor = Doctor::factory()->create();
        $specialtyType = SpecialtyType::factory()->create();
        $specialty = Specialty::factory()->create(['specialty_type_id' => $specialtyType->id]);
        $this->rawData['doctor_id'] = $doctor->id;
        $this->rawData['specialty_id'] = $specialty->id;

        $model = DoctorSpecialty::factory()->create($this->rawData);

        $this->putJson(route($this->modelName . '.update', [$this->paramName => $model->id]), $this->rawData)
            ->assertStatus(401);
    }

    // updateda agar unique fieldlarni o'zgartirmasdan jo'natilsa xato qaytmasligi kerak
    public function test_can_update_item_with_not_changed_unique_fields_on_update()
    {
        $doctor = Doctor::factory()->create();
        $specialtyType = SpecialtyType::factory()->create();
        $specialty = Specialty::factory()->create(['specialty_type_id' => $specialtyType->id]);
        $this->rawData['doctor_id'] = $doctor->id;
        $this->rawData['specialty_id'] = $specialty->id;

        $model = DoctorSpecialty::factory()->create($this->rawData);

        $specialty2 = Specialty::factory()->create(['specialty_type_id' => $specialtyType->id]);
        $this->rawData['doctor_id'] = $doctor->id;
        $this->rawData['specialty_id'] = $specialty2->id;
        $this->rawData['certificate_due_date'] = date('Y-m-d');

        $this->putJson(route($this->modelName . '.update', [$this->paramName => $model->id]), $this->rawData, $this->getHeadersWithToken())
            ->assertStatus(200);
    }

    // updateda agar required fieldlar jonatilmasa xato qaytishi kerak
    public function test_return_validation_error_without_sending_required_fields_on_update()
    {
        $doctor = Doctor::factory()->create();
        $specialtyType = SpecialtyType::factory()->create();
        $specialty = Specialty::factory()->create(['specialty_type_id' => $specialtyType->id]);

        $model = DoctorSpecialty::factory()->create($this->rawData);

        $rawData = [
            'doctor_id' => $doctor->id,
        ];

        $rawData2 = [
            'specialty_id' => $specialty->id
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
        $doctor = Doctor::factory()->create();
        $specialtyType = SpecialtyType::factory()->create();
        $specialty = Specialty::factory()->create(['specialty_type_id' => $specialtyType->id]);
        $this->rawData['doctor_id'] = $doctor->id;
        $this->rawData['specialty_id'] = $specialty->id;

      DoctorSpecialty::factory()->create($this->rawData);

        $params = [
            'doctor_id' => $doctor->id,
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
        $doctor = Doctor::factory()->create();
        $specialtyType = SpecialtyType::factory()->create();
        $specialty = Specialty::factory()->create(['specialty_type_id' => $specialtyType->id]);
        $this->rawData['doctor_id'] = $doctor->id;
        $this->rawData['specialty_id'] = $specialty->id;

        $model = DoctorSpecialty::factory()->create($this->rawData);

        $this->deleteJson(route($this->modelName . '.destroy', [$this->paramName => $model->id]),[], $this->getHeadersWithToken())
            ->assertStatus(204);
    }

    // delete da agar headerda token berilmasa, 401 qaytishi kerak
    public function test_return_unauthorized_error_when_token_is_wrong_on_delete()
    {
        $doctor = Doctor::factory()->create();
        $specialtyType = SpecialtyType::factory()->create();
        $specialty = Specialty::factory()->create(['specialty_type_id' => $specialtyType->id]);
        $this->rawData['doctor_id'] = $doctor->id;
        $this->rawData['specialty_id'] = $specialty->id;

        $model = DoctorSpecialty::factory()->create($this->rawData);

        $this->deleteJson(route($this->modelName . '.destroy', [$this->paramName => $model->id]))
            ->assertStatus(401);
    }

    // delete da agar berilgan model_id topilmasa xato qaytishi kerak
    public function test_return_not_found_error_when_wrong_item_id_is_sent_on_delete()
    {
        $doctor = Doctor::factory()->create();
        $specialtyType = SpecialtyType::factory()->create();
        $specialty = Specialty::factory()->create(['specialty_type_id' => $specialtyType->id]);
        $this->rawData['doctor_id'] = $doctor->id;
        $this->rawData['specialty_id'] = $specialty->id;

        $model = DoctorSpecialty::factory()->create($this->rawData);

        $this->deleteJson(route($this->modelName . '.destroy', [$this->paramName => $model->id + 1]), $this->getHeadersWithToken())
            ->assertStatus(404);
    }


    // toggle

    // toggle da agar header token berilsa va form ma'lumotlari jo'natilsa va type = 1 bo'lsa, 200 qaytishi kerak
    public function test_can_toggle_create_item()
    {
        $doctor = Doctor::factory()->create();
        $specialtyType = SpecialtyType::factory()->create();
        $specialty = Specialty::factory()->create(['specialty_type_id' => $specialtyType->id]);

        $formData = [
            'doctor_id' => $doctor->id,
            'specialty_id' => $specialty->id,
            'type' => 1,
        ];

        $this->json("post", route($this->modelNamePlural . '.toggle'), $formData, $this->getHeadersWithToken())
            ->assertStatus(200);
    }

    // toggle da agar headerda token berilmasa, 401 qaytishi kerak
    public function test_return_unauthorized_error_when_token_is_wrong_on_toggle()
    {
        $doctor = Doctor::factory()->create();
        $specialtyType = SpecialtyType::factory()->create();
        $specialty = Specialty::factory()->create(['specialty_type_id' => $specialtyType->id]);

        $formData = [
            'doctor_id' => $doctor->id,
            'specialty_id' => $specialty->id,
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


}
