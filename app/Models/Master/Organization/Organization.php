<?php

namespace App\Models\Master\Organization;

use App\Models\Master\Contact\Contact;
use App\Models\Master\OrganizationDoctor\OrganizationDoctor;
use App\Models\Master\OrganizationService\OrganizationService;
use App\Models\Master\OrganizationType\ViewOrganizationType;
use App\Models\Master\Picture\Picture;
use App\Models\Master\WeeklySchedule\WeeklyScheduleTranslation;
use App\Traits\NewHasFactory;
use Database\Factories\OrganizationFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Organization extends Model
{
    use SoftDeletes;
    use NewHasFactory;
    protected static string $factoryModel = OrganizationFactory::class;

        protected $fillable = [
        'organization_type_id',
        'weekly_schedule_id',
        'database_name',
        'created_by',
        'updated_by',
        'deleted_by',
        'status'
    ];

    public function translations()
    {
        return $this->hasMany(OrganizationTranslation::class, 'organization_id', 'id');
    }

    public function translation()
    {
        return $this->hasOne(OrganizationTranslation::class, 'organization_id', 'id');
    }

    public function organizationServices()
    {
        return $this->hasMany(OrganizationService::class, 'organization_id', 'id');
    }

    public function organizationType()
    {
        return $this->hasMany(ViewOrganizationType::class, 'id', 'organization_type_id');
    }

    public function organizationDoctors()
    {
        return $this->hasMany(OrganizationDoctor::class, 'organization_id', 'id');
    }

    public function defaultPicture()
    {
        return $this->hasOne(Picture::class, 'object_id', 'id')
            ->where('object_type', 'organization')
            ->where('is_default', 1);
    }

    public function contacts()
    {
        return $this->hasMany(Contact::class, 'object_id', 'id')
            ->where('object_type', 'organization');
    }

    public function workSchedules()
    {
        return $this->hasOne(WeeklyScheduleTranslation::class, 'id', 'weekly_schedule_id');
    }
}
