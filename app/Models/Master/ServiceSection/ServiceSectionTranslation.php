<?php

namespace App\Models\Master\ServiceSection;

use App\Models\Master\Language\Language;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServiceSectionTranslation extends Model
{
    //
    use HasFactory;

    public $timestamps = false;

    protected $fillable = ['service_section_id', 'language_code', 'name'];

    public function language()
    {
        return $this->hasOne(Language::class, 'code', 'language_code');
    }
}
