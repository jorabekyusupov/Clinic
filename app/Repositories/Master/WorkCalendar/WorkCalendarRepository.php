<?php

namespace App\Repositories\Master\WorkCalendar;

use App\Models\Master\WorkCalendar\WorkCalendar;
use App\Repositories\Repository;

class WorkCalendarRepository extends Repository
{
    public function __construct(WorkCalendar $workCalendar)
    {
        $this->model = $workCalendar;
    }
}
