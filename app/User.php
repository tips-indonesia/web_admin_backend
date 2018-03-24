<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use Notifiable;
    use HasRoles;

    protected $table = 'member_lists';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name', 
        'last_name', 
        'email', 
        'password', 
        'mobile_phone_no',
        'registered_date',
        'profil_picture',
        'birth_date',
        'address',
        'status',
        'is_worker',
        'id_office',
        'sex'
    ];

    // *
    //  * The attributes that should be hidden for arrays.
    //  *
    //  * @var array
     
    protected $hidden = [
        'password', 'remember_token',
    ];

}
