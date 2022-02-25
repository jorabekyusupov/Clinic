<?php

namespace App\Models\Master\RoleUser;

use App\Traits\NewHasFactory;
use Illuminate\Database\Eloquent\Model;

class RoleUser extends Model
{
    use NewHasFactory;

    protected $table = 'role_user';
    public
        $timestamps = false,
        $incrementing = false;
    protected
        $primaryKey = false,
        $fillable = ['role_id', 'user_id', 'user_type'];
}
