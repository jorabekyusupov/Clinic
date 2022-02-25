<?php

namespace App\Models\Master\ServiceClass;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServiceClass extends Model
{
    //
    use HasFactory;

    protected $fillable = ['code', 'created_by', 'updated_by', 'deleted_by'];
    public function translations()
    {
        return $this->hasMany(ServiceClassTranslation::class, 'service_class_id', 'id');
    }

    public function translation()
    {
        return $this->hasOne(ServiceClassTranslation::class, 'service_class_id', 'id');
    }
}
