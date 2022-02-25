<?php

namespace App\Models\Master\Specialty;

use App\Models\Master\SpecialtyType\ViewSpecialtyType;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ViewSpecialty extends Model
{
    use SoftDeletes;

    public function specialtyType()
    {
        return $this->hasOne(ViewSpecialtyType::class, 'id', 'specialty_type_id');
    }
}
