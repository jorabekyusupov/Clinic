<?php

namespace App\Models\Master\DoctorStudy;

use App\Models\Master\Specialty\ViewSpecialty;
use App\Models\Master\StudyDegree\ViewStudyDegree;
use App\Models\Master\StudyType\ViewStudyType;
use App\Models\Master\University\ViewUniversity;
use App\Traits\NewHasFactory;
use Database\Factories\DoctorStudyFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DoctorStudy extends Model
{
    use SoftDeletes;
    use NewHasFactory;
    protected static string $factoryModel = DoctorStudyFactory::class;


    protected $fillable = ['doctor_id','study_type_id','university_id','study_degree_id','specialty_id','direction','description','began_year','graduated_year','created_by','updated_by','deleted_by'];

    public function doctorStudyType()
    {
        return $this->hasOne(ViewStudyType::class, 'id', 'study_type_id')
            ->select('id', 'language_code', 'name');
    }

    public function doctorUniversity()
    {
        return $this->hasOne(ViewUniversity::class, 'id', 'university_id')
            ->select('id', 'language_code', 'name');
    }

    public function doctorStudyDegree()
    {
        return $this->hasOne(ViewStudyDegree::class, 'id', 'study_degree_id')
            ->select('id', 'language_code', 'name');
    }

    public function doctorSpecialty()
    {
        return $this->hasOne(ViewSpecialty::class, 'id', 'specialty_id')
            ->select('id', 'language_code', 'name');
    }
}
