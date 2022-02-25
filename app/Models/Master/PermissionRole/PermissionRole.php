<?php

namespace App\Models\Master\PermissionRole;


use App\Traits\NewHasFactory;
use Illuminate\Database\Eloquent\Model;

class PermissionRole extends Model
{
    use NewHasFactory;



    protected $table = 'permission_role';

    public $timestamps = false;

    public $incrementing = false;

    protected $fillable = ['permission_id', 'role_id'];
}
