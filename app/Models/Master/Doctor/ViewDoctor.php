<?php

namespace App\Models\Master\Doctor;

use App\Models\Master\Contact\Contact;
use App\Models\Master\DoctorSpecialty\DoctorSpecialty;
use App\Models\Master\Picture\Picture;
use App\Models\Master\Specialty\ViewSpecialty;
use App\Models\Master\WeeklySchedule\WeeklyScheduleTranslation;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class  ViewDoctor extends Model
{
    use SoftDeletes;

    public function doctorSpecialties()
    {
        return $this->hasMany(DoctorSpecialty::class, 'doctor_id', 'id');
    }

    public function specialties()
    {
        return $this->hasManyThrough(ViewSpecialty::class, DoctorSpecialty::class,
            'doctor_id', 'id', 'id', 'specialty_id');
    }

    public function default_picture()
    {
        return $this->hasOne(Picture::class, 'object_id', 'id')
            ->where('object_type', 'doctor')
            ->where('is_default', 1);
    }

    public function contacts()
    {
        return $this->hasMany(Contact::class, 'object_id', 'id')
            ->where('object_type', 'doctor');
    }

    public function workSchedules()
    {
        return $this->hasOne(WeeklyScheduleTranslation::class, 'id', 'weekly_schedule_id');
    }

}
