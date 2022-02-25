<?php

namespace App\Models\Master\OrganizationDoctor;

use App\Models\Master\Doctor\Doctor;
use App\Models\Master\Organization\Organization;
use App\Traits\NewHasFactory;
use Database\Factories\OrganizationDoctorFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class OrganizationDoctor extends Model
{
    use SoftDeletes;
    use NewHasFactory;
    protected static string $factoryModel = OrganizationDoctorFactory::class;


    protected $fillable = ['organization_id', 'doctor_id', 'created_by', 'updated_by', 'deleted_by'];

    public function doctor()
    {
        return $this->hasOne(Doctor::class, 'id', 'doctor_id');
    }

    public function organization()
    {
        return $this->hasOne(Organization::class, 'id', 'organization_id');
    }
}
