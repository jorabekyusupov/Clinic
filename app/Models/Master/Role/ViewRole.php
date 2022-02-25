<?php

namespace App\Models\Master\Role;

use App\Models\Master\RoleUser\RoleUser;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ViewRole extends Model
{
    use SoftDeletes;

    public function user()
    {
        return $this->hasOne(RoleUser::class, 'role_id', 'id');
    }
}
