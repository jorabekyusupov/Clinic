<?php

namespace App\Models\Master\WeeklySchedule;


use Illuminate\Database\Eloquent\Model;

class ViewWeeklySchedule extends Model
{
    public function translations()
    {
        return $this->hasMany(WeeklyScheduleTranslation::class, 'weekly_schedule_id', 'id');
    }

    public function translation()
    {
        return $this->hasOne(WeeklyScheduleTranslation::class, 'weekly_schedule_id', 'id');
    }
}
