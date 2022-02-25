<?php

namespace App\Models\Master\Permission;

use App\Models\Master\PermissionRole\PermissionRole;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ViewPermission extends Model
{
    use SoftDeletes;

    public function role()
    {
        return $this->hasOne(PermissionRole::class, 'permission_id', 'id');
    }
}
