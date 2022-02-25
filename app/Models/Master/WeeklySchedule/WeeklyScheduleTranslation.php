<?php

namespace App\Models\Master\WeeklySchedule;

use App\Models\Master\Language\Language;
use App\Traits\NewHasFactory;
use Database\Factories\WeeklyScheduleTranslationFactory;
use Illuminate\Database\Eloquent\Model;

class WeeklyScheduleTranslation extends Model
{
    use NewHasFactory;

    protected static string $factoryModel = WeeklyScheduleTranslationFactory::class;

    public $timestamps = false;
    protected $fillable = ['weekly_schedule_id','language_code','name'];

    public function language(){
        return $this->hasOne(Language::class, 'code', 'language_code');
    }
}
