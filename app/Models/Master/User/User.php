<?php

namespace App\Models\Master\User;

use App\Models\Master\Person\Person;
use App\Traits\NewHasFactory;
use Database\Factories\UserFactory;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;
use Laratrust\Traits\LaratrustUserTrait;
use Laravel\Passport\HasApiTokens;

class User extends Authenticatable
{
    use NewHasFactory;
    use LaratrustUserTrait, HasApiTokens, Notifiable, SoftDeletes;

    protected static string $factoryModel = UserFactory::class;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['username','email','email_verified_at','default_database','password','status','remember_token','person_id','created_by','updated_by','deleted_by'];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function findAndValidateForPassport($username, $password)
    {
        $user = $this->where('username', $username)->orWhere('email', $username)->first();
        if (! Hash::check($password, $user->password)) {
            return false;
        }
        return $user;
    }
    public function person()
    {
        return $this->hasOne(Person::class, 'id', 'person_id');
    }
}
