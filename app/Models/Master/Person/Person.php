<?php

namespace App\Models\Master\Person;

use App\Traits\NewHasFactory;
use Database\Factories\PersonFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Person extends Model
{
    use NewHasFactory;
    use SoftDeletes;

    protected static string $factoryModel = PersonFactory::class;

    protected $fillable = ['first_name','last_name','middle_name','born_date','jshshir','gender','created_by','updated_by','deleted_by',];
}
