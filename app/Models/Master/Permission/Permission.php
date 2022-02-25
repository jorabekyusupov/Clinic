<?php

namespace App\Models\Master\Permission;

use App\Traits\NewHasFactory;
use Database\Factories\PermissionFactory;
use Laratrust\Models\LaratrustPermission;

class Permission extends LaratrustPermission
{
    use NewHasFactory;

    protected static string $factoryModel = PermissionFactory::class;


    public $fillable = ['type', 'name', 'created_by', 'updated_by', 'deleted_by'];

    public function translations()
    {
        return $this->hasMany(PermissionTranslation::class, 'permission_id', 'id');
    }

    public function translation()
    {
        return $this->hasOne(PermissionTranslation::class, 'permission_id', 'id');
    }
}
