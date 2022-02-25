<?php

namespace App\Models\Master\ServiceSubsection;

use App\Models\Master\Language\Language;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServiceSubsectionTranslation extends Model
{
    //
    use HasFactory;

    protected $fillable = ['service_subsection_id','language_code','name'];
    public $timestamps = false;

    public function language()
    {
        return $this->hasOne(Language::class, 'code', 'language_code');
    }
}
