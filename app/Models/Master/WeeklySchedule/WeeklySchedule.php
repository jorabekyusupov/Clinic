<?php

namespace App\Models\Master\WeeklySchedule;

use App\Traits\NewHasFactory;
use Database\Factories\WeeklyScheduleFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class WeeklySchedule extends Model
{
    use SoftDeletes;
    use NewHasFactory;

    protected static string $factoryModel = WeeklyScheduleFactory::class;


    protected $fillable = ['code', 'created_by', 'updated_by', 'deleted_by'];

    public function translations()
    {
        return $this->hasMany(WeeklyScheduleTranslation::class, 'weekly_schedule_id', 'id');
    }

    public function translation()
    {
        return $this->hasOne(WeeklyScheduleTranslation::class, 'weekly_schedule_id', 'id');
    }

}
