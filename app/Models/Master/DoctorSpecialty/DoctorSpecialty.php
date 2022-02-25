<?php

namespace App\Models\Master\DoctorSpecialty;


use App\Models\Master\Specialty\ViewSpecialty;
use App\Traits\NewHasFactory;
use Database\Factories\DoctorSpecialtyFactory;
use Illuminate\Database\Eloquent\Model;

class DoctorSpecialty extends Model
{
    use NewHasFactory;

    protected static string $factoryModel = DoctorSpecialtyFactory::class;

    public $timestamps = false;
    protected $fillable = [
        'doctor_id',
        'specialty_id',
        'created_by',
        'updated_by',
        'deleted_by'
    ];

    public function specialty()
    {
        return $this->hasOne(ViewSpecialty::class, 'id', 'specialty_id');
    }
}
