<?php

namespace App\Models\Master\Organization;

use App\Models\Master\Contact\Contact;
use App\Models\Master\OrganizationType\ViewOrganizationType;
use App\Models\Master\Picture\Picture;
use Illuminate\Database\Eloquent\Model;
use App\Models\Master\WeeklySchedule\WeeklyScheduleTranslation;

class ViewOrganization extends Model
{
    public function organizationType()
    {
        return $this->hasOne(ViewOrganizationType::class, 'id', 'organization_type_id');
    }

    public function default_picture()
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
