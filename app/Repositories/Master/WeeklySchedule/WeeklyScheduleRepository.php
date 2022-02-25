<?php

namespace App\Repositories\Master\WeeklySchedule;

use App\Models\Master\WeeklySchedule\ViewWeeklySchedule;
use App\Models\Master\WeeklySchedule\WeeklySchedule;
use App\Models\Master\WeeklySchedule\WeeklyScheduleTranslation;
use App\Repositories\Repository;

class WeeklyScheduleRepository extends Repository
{

    public function __construct(WeeklySchedule $weeklySchedule, WeeklyScheduleTranslation $weeklyScheduleTranslation, ViewWeeklySchedule $viewWeeklySchedule)
    {
        $this->model = $weeklySchedule;
        $this->modelTranslation = $weeklyScheduleTranslation;
        $this->modelView = $viewWeeklySchedule;
    }
}
