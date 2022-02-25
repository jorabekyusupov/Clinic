<?php

namespace App\Models\Master\ServiceSection;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServiceSection extends Model
{
    //
    use HasFactory;

    protected $fillable = ['code', 'created_by','updated_by', 'deleted_by'];
    public function translations()
    {
        return $this->hasMany(ServiceSectionTranslation::class, 'service_section_id', 'id');
    }

    public function translation()
    {
        return $this->hasOne(ServiceSectionTranslation::class, 'service_section_id', 'id');
    }
}
