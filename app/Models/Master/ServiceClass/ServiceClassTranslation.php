<?php

namespace App\Models\Master\ServiceClass;

use App\Models\Master\Language\Language;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServiceClassTranslation extends Model
{
    //
    use HasFactory;

    public $timestamps = false;
    protected $fillable = ['service_class_id', 'language_code', 'name'];

    public function language()
    {
        return $this->hasOne(Language::class, 'code', 'language_code');
    }
}
