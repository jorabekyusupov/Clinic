<?php

namespace App\Models\Master\Contact;

use App\Traits\NewHasFactory;
use Database\Factories\ContactFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    use NewHasFactory;
    protected static string $factoryModel = ContactFactory::class;


    protected $fillable = ['object_type','contact_type','object_id','value','created_by','updated_by'];
}
