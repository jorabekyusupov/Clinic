<?php

namespace App\Models\Master\WorkCalendar;

use App\Traits\NewHasFactory;
use Database\Factories\WorkCalendarFactory;
use Illuminate\Database\Eloquent\Model;

class WorkCalendar extends Model
{
    use NewHasFactory;

    protected static string $factoryModel = WorkCalendarFactory::class;


    public $timestamps = false;

    protected $fillable = ['calendar_date', 'work_day_sequence', 'is_work_day', 'is_weekend', 'is_holiday', 'holiday_name'];
}
