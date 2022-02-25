<?php

namespace App\Models\Master\Language;


use App\Traits\NewHasFactory;
use Database\Factories\LanguageFactory;
use Illuminate\Database\Eloquent\Model;

class Language extends Model
{
    use NewHasFactory;
    protected static string $factoryModel = LanguageFactory::class;


    public $timestamps = false;
    protected $fillable = ['code', 'name', 'is_active', 'created_by', 'updated_by'];
}
