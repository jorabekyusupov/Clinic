<?php

namespace App\Models\Master\Role;

use App\Traits\NewHasFactory;
use Database\Factories\RoleFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Laratrust\Models\LaratrustRole;

class Role extends LaratrustRole
{
    use NewHasFactory;

    protected static string $factoryModel = RoleFactory::class;

    protected $fillable = ['name', 'type', 'created_by', 'updated_by', 'deleted_by'];

    use SoftDeletes;

    public function translations()
    {
        return $this->hasMany(RoleTranslation::class, 'role_id', 'id');
    }

    public function translation()
    {
        return $this->hasOne(RoleTranslation::class, 'role_id', 'id');
    }
}
