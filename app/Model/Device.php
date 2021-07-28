<?php

namespace App\Model;

use Illuminate\Auth\Authenticatable;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Database\Eloquent\Model;
use Laravel\Lumen\Auth\Authorizable;

class Device extends Model implements AuthenticatableContract, AuthorizableContract
{
    use Authenticatable, Authorizable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id_device', 'nama_device', 'id_soldier'
    ];

    // /**
    //  * The attributes excluded from the model's JSON form.
    //  *
    //  * @var array
    //  */
    // protected $hidden = [
    //     'password', 'api_token'
    // ];
}
