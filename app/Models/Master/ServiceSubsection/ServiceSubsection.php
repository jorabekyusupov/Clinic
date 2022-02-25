<?php

namespace App\Models\Master\ServiceSubsection;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServiceSubsection extends Model
{
    //
    use HasFactory;

    protected $fillable = ['code','created_by','updated_by','deleted_by'];
    public function translations()
    {
        return $this->hasMany(ServiceSubsectionTranslation::class, 'service_subsection_id', 'id');
    }

    public function translation()
    {
        return $this->hasOne(ServiceSubsectionTranslation::class, 'service_subsection_id', 'id');
    }
}
