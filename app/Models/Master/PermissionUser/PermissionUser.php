<?php

namespace App\Models\Master\PermissionUser;

use App\Traits\NewHasFactory;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class PermissionUser extends Model
{
    use NewHasFactory;


    protected $table = 'permission_user';
    public $timestamps = false;
    protected $primaryKey = ['permission_id', 'user_id'];

    protected function setKeysForSaveQuery($query)
    {
        $query
            ->where('permission_id', '=', $this->getAttribute('permission_id'))
            ->where('user_id', '=', $this->getAttribute('user_id'));
        return $query;
    }

    public $incrementing = false;
}
